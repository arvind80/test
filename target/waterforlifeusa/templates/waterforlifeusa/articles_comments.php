<? if($post['comments_enabled'] != 'n') : ?>






 <h2 class="title" style="padding: 15px 0;">Your comments</h2>






                    <script type="text/javascript">
                        $(document).ready(function(){
                            var options ={
                                      target:        'test.php',
                                      beforeSubmit:  bSubmit,
                                      success:       aSubmit
                            }
                            $("#comments-form").submit(function(){
                                if($(this).hasClass("error")){}
                                else{
                                  $(this).ajaxSubmit(options);
                                }
                                return false;
                            });

                        });

                        function bSubmit(formData){
                            alert($.param(formData))

                        }
                        function aSubmit(){
                            alert("Comment sent")
                        }
                    </script>

















































<div id="comments_container"> <a name="the_comments_anchor" id="the_comments_anchor"></a>
  <? $comments = array();
$comments ['to_table'] = 'table_content';
$comments ['to_table_id'] = $post['id'];
$comments = $this->comments_model->commentsGet($comments);
?>
  <? if(!empty($comments)) : ?>
  <? foreach($comments as $item): ?>
  <div class="comment gradient_top cblock">
    <span class="date right"><? print $item['created_on'] ?></span>
    <!--<div class="avatar">
        <span></span>
        <div style="background-image: url(<?php // echo gravatar( $item['comment_email'], $rating = 'X', $size = '30', $default =  TEMPLATE_URL .'img/gravatar.jpg' ); ?>)"></div> 
    </div>-->
        <h2 class="title" style="cursor: pointer" onclick="goto('<? print prep_url($item['comment_website']) ?>')"><? print $item['comment_name'] ?></h2>
        <div style="clear: both"></div>
       <p> <? print ($item['comment_body']); ?></p>

  </div>
  <?  endforeach ; ?>
  <? else : ?>
  <div class="box comment wrap">
    <div class="comment_content">
      <p>No comments yet. Be the first to comment.</p>
    </div>
  </div>
  <? endif; ?>
</div>
<script type="text/javascript">

function refresh_after_post_comment(){
		var refresh_the_page = "<? print $this->content_model->contentGetHrefForPostId($post['id']) ; ?>#the_comments_anchor";
		//window.location=refresh_the_page;
		window.location.reload();
	}



    $(document).ready(function(){
       $("#comments_form input, #comments_form textarea").focus(function(){$(this).addClass("focus")});
       $("#comments_form input, #comments_form textarea").blur(function(){$(this).removeClass("focus")});

       $("#comments_form").validate();



    CommentOptions = {

		url:       '<? print site_url('main/comments_post'); ?>'  ,
		clearForm: true,
		type:      'post',
        beforeSubmit:  comments_before,  //
        success:       comments_after

    };

    $('#comments_form').submit(function(){
        $(this).ajaxSubmit(CommentOptions);
        return false;
    });

    function  comments_before(){
        var TF = true;
        if($("#comments_form textarea.error").exists() || $("#comments_form input.error").exists()){
            TF = false;

        }
        var test_tf = TF;
        if(test_tf==true){
          $("#cf_submit").hide();
        }
        return TF;

    }
    function  comments_after(){
       var success_elem = document.createElement("span");
       success_elem.className = "success_elem";
       success_elem.innerHTML = "Your message has been sent."
       $("#comments_form").append(success_elem);
	   refresh_after_post_comment();
    }



    });

</script>

<h2 class="title" style="padding: 15px 0 10px 0">Leave your comment</h2>

<div id="commentForm">
  <form method="post" action="#" id="comments_form">
    <input type="hidden" name="to_table_id" id="to_table_id"  value="<? print (base64_encode($post['id']) ); ?>"  />
    <input type="hidden" name="to_table" id="to_table"  value="<? print (base64_encode('table_content') ); ?>"  />
    <label>Name:*</label>
    <div class="box boxv2 wrap">
      <input type="text" name="comment_name" class="required" />
    </div>
    <label>Email:*</label>
    <div class="box boxv2 wrap">
      <input type="text" name="comment_email" class="required email" />
    </div>
    <label>Website:</label>
    <div class="box boxv2 wrap">
      <input name="comment_website" type="text" />
    </div>
    <label>Comment:*</label>
    <div class="box boxv2 wrap">
      <textarea rows="" cols="" name="comment_body" class="required"></textarea>
    </div>
    <div style="height: 10px"></div>
    <a onclick="$('#comments_form').submit();" class="btn right" id="cf_submit" href="javascript:;"><span>Post comment</span></a>
  </form>
</div>
<? endif; ?>