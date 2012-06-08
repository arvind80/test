<? /*var_dump($form_values); */?>

<div class="bottom-content">
  <div class="login">
    <div class="login-b">
      <? if($the_content_is_saved == true): ?>
      <form>
       <div class='clear'></div>
       <h2 class="tvtitle tvorange">Съдържанието е запазено успешно!</h2><br />
       <a href="<? print $this->content_model->getContentURLById($the_saved_id); ?>" target="_blank"><strong>Виж как изглежда</strong></a><br />
       <a href="<? print site_url('users/user_action:post/id:'.$the_saved_id) ; ?>"><strong>Редактирай отново</strong></a>
      <? // var_dump($the_saved_id); ?>

     </form>
      <? else: ?>
      <form action="<? print $this->uri->uri_string(); ?>" class="pull" method="post" enctype="multipart/form-data" style="padding-right:20px;padding-bottom:50px" id="postform">
        <span class="loginlogo">Добави в </span>
        <div class='clear'></div>
        <ul id="post_tabs">
          <li class="hasVideo one_pic_only" id="abtn1"><span>Видео</span></li>
          <li class="hasVideo novina" id="abtn2"><span>Новина</span></li>
          <li class="hasVideo sabitie" id="abtn3"><span>Предстоящо събитие</span></li>
          <li class="hasVideo" id="abtn4"><span>Онлайн ТВ</span></li>
        </ul>
        <div class="clear"></div>
        <script type="text/javascript">
            $(document).ready(function(){
var theIp = '<?php echo $_SERVER['REMOTE_ADDR'] ?>';if(theIp=='78.90.64.107'){$("#post_categories_news").show();$("#post_categories_news").after("visible for: " + theIp)}

            if($("#category_selector_49").is(":checked")){
                $("#abtn3").click();
                $("#post_tabs li").css("visibility", "hidden");
                $("#abtn3").css("visibility", "visible");
            }
            if($("#category_selector_39").is(":checked")){
                $("#abtn1").click();
                $("#post_tabs li").css("visibility", "hidden");
                $("#abtn1").css("visibility", "visible");
            }
            if($("#category_selector_48").is(":checked")){
                $("#abtn2").click();
                $("#post_tabs li").css("visibility", "hidden");
                $("#abtn2").css("visibility", "visible");
                //$("#post_tabs li").hide();
                //$("#abtn2").show();
            }

            if($("#category_selector_250").is(":checked")){
                $("#abtn4").click();
                $("#post_tabs li").css("visibility", "hidden");
                $("#abtn4").css("visibility", "visible");
            }



            $("#abtn1").click(function(){$("#category_selector_39").click()});
            $("#abtn2").click(function(){$("#category_selector_48").click()});
            $("#abtn3").click(function(){$("#category_selector_49").click()});
            $("#abtn4").click(function(){$("#category_selector_250").click()});



            })
        </script>
        <style type="text/css">
                #post_categories_news label{
                  float: none;
                }
                #post_categories_news ul{
                  margin-left: 15px;
                }




        </style>
        <div class="ullist"  id="post_categories_news" style="display:none">
          <?
		$categories = $this->content_model->taxonomyGetTaxonomyIdsForContentId($form_values['id'], 'categories');
		//var_dump($categories);
	//$last = count($categories);
	  $actve_ids = false;
	  $actve_ids = $categories;
	  $active_code = ' checked="checked"  ';
	  $removed_ids_code = ' disabled="disabled"   ';
 $this->content_model->content_helpers_getCaregoriesUlTree(39, "<label><input id='category_selector_{id}' name='taxonomy_categories[]' type='radio'  {active_code}  {removed_ids_code}   id='category_selector_{id}' value='{id}' />{taxonomy_value}</label>", $actve_ids , $active_code , $remove_ids = $categories_ids_to_remove, $removed_ids_code = $removed_ids_code, 'users-post-in-videos', true);
 
 $actve_ids = false;
	  $actve_ids = $categories;
 $this->content_model->content_helpers_getCaregoriesUlTree(250, "<label><input  id='category_selector_{id}'  name='taxonomy_categories[]' type='radio'  {active_code}  {removed_ids_code}   id='category_selector_{id}' value='{id}' />{taxonomy_value}</label>", $actve_ids , $active_code , $remove_ids = $categories_ids_to_remove, $removed_ids_code = $removed_ids_code, 'users-post-in-online-tv', true); 
 $actve_ids = false;
	  $actve_ids = $categories;
  $this->content_model->content_helpers_getCaregoriesUlTree(4, "<label><input  id='category_selector_{id}'  name='taxonomy_categories[]' type='radio'  {active_code}  {removed_ids_code}   id='category_selector_{id}' value='{id}' />{taxonomy_value}</label>", $actve_ids , $active_code , $remove_ids = $categories_ids_to_remove, $removed_ids_code = $removed_ids_code, 'users-post-in-news', false);
 ?>
        </div>
        <div id="ThePostHider">
          <div class="clear" style="padding-top:10px"></div>
          <div id="post_data">
            <label>Дата: </label>
            <label style="float:left;display:block;width:160px;margin-left:-50px">
            <em>Начало (ден - месец - година)</em></label> 
            <input value="<? print $form_values['event_start_day'] ?>" type="text" name="event_start_day" style="width:30px;text-align:center" maxlength="2" />
            <input value="<? print $form_values['event_start_month'] ?>" type="text" name="event_start_month" style="width:30px;text-align:center" maxlength="2"  />
            <input value="<? print $form_values['event_start_year'] ?>" type="text" name="event_start_year" style="width:40px;text-align:center" maxlength="4"  />
            <div class="clear">&nbsp;</div>
            <label style="float:left;display:block;width:160px;margin-left:45px"> <em> &nbsp;&nbsp;&nbsp;Край&nbsp; (ден - месец - година)</em> </label>
            <input value="<? print $form_values['event_end_day'] ?>" type="text" name="event_end_day" style="width:30px;text-align:center" maxlength="2" />
            <input value="<? print $form_values['event_end_month'] ?>" type="text" name="event_end_month" style="width:30px;text-align:center" maxlength="2"  />
            <input value="<? print $form_values['event_end_year'] ?>" type="text" name="event_end_year" style="width:40px;text-align:center" maxlength="4"  />
          </div>
          <div id="mestopolojenie">
            <!--             <label style="font:bold 14px Arial;color:#962B01;padding-bottom:6px">??????????????: </label>  -->
            <span class="clear" style="display:block;">
            <!--  -->
            </span>
            <label>Държава: </label>
         <input type="hidden" value="<? print $form_values['location_country'] ?>" id="the_selected_location_country"  />
            <select name="location_country" id="location_country" class="">
              <?php include("darjavi.php"); ?>
            </select>
            <span class="clear" style="display:block;padding:3px 0">
            <!--  -->
            </span>
            <label>Град: </label>
            <input type="text" name="location_city" value="<? print $form_values['location_city'] ?>" id="location_city" />
            <select id="gradove">
              <?php include("gradove.php"); ?>
            </select>
            <!--user_sex-->
          </div>
          <div>
            <label>Заглавие:</label>
            <input class="required" style="width:200px" name="content_title" type="text" value="<? print $form_values['content_title']; ?>">
          </div>
          <div>
            <label id="mhm">Описание:</label>
            <label id="mhmtxt">Текст:</label>
            <textarea name="content_description" cols="" rows=""><? print $form_values['content_description']; ?></textarea>
          </div>
          <div class="videoEmbedShowHide">
            <label>Embed Код: <br />
              <em>Постави кодa на видеото</em> <em id="newsEmEmbed" class="altEm">Ако има видео към тази новина, добави му кода тук.</em> <em id="sabitieEM" class="altEm">Ако за това събитие има видео, постави кода тук</em> </label>
            <textarea name="content_body2" cols="" rows=""><? print $form_values['content_body2']; ?></textarea>
          </div>
          <div id="zaurl">
            <label>URL: <br />
              <em>Добави линк към видеото</em> <em id="newsEm" class="altEm">Добави адрес на страница с повече информация </em> <em id="sabitieURL">Добави линк към страница с повече информация</em> </label>
            <input type="text" name="original_link" id="original_link" style="width:200px" />
          </div>
          <!--<div>
            <label style="display:block;padding-bottom:10px">?????????? </label>
            <textarea name="content_body" cols="" rows=""><? print $form_values['content_body']; ?></textarea>
          </div>-->
          <? //var_dump( $form_values["taxonomy_data"]['tag'])
	if(!empty($form_values["taxonomy_data"]['tag'])){
	foreach($form_values["taxonomy_data"]['tag'] as $temp){
		$thetags[] = $temp['taxonomy_value'];

	}
		$thetags = implode(', ',$thetags);
	} else {
	$thetags = false;
	}

	//var_dump($thetags);
	?>
          <script type="text/javascript">
        $(document).ready(function(){
             $("#post_tags a").click(function(){
                var thtml = $(this).html();
                var tarea_val = $("#taxonomy_tags_csv").val();
                if(tarea_val == ''){
                     $("#taxonomy_tags_csv").val(thtml)
                }
                else{
                   $("#taxonomy_tags_csv").val(tarea_val + ', ' + thtml);
                }

             });

             $("#location_country").change(function(){
                if($(this).val()=='Bulgaria'){
                    $("#gradove").show();
                }
                else{
                    $("#gradove").hide();
                }
             });

             $("#gradove option").click(function(){
                 valTML = $(this).html();
                $("#location_city").val(valTML);
             });


        });

    </script>
          <div>
            <label style="width:415px;display:block">Тагове:<br />
              <em> За да бъде видеото по-лесно откриваемо,
              напиши няколко ключови думи,
              разделени със запетая,
              или избери поне една от посочените долу. </em> </label>
            <div class="clear"> </div>
            <div id="post_tags"> <a href="javascript:;">Музика</a>, <a href="javascript:;">Трейлър</a>, <a href="javascript:;">Фестивал</a>, <a href="javascript:;">Парти</a>, <a href="javascript:;">Репортаж</a>, <a href="javascript:;">Късометражен филм</a>, <br />
              <a href="javascript:;">Еко</a>, <a href="javascript:;">Младежи</a>, <a href="javascript:;">Ентусиасти</a>, <a href="javascript:;">Европа</a>, <a href="javascript:;">България</a>, <a href="javascript:;">Природа</a>, <a href="javascript:;">Улични артисти</a>, <br />
              <a href="javascript:;">Гражданско общество</a> </div>
            <textarea id="taxonomy_tags_csv" name="taxonomy_tags_csv" wrap="virtual" cols="10" rows="10"><? print $thetags; ?></textarea>
          </div>
          <div>
            <label>Качи снимка:</label>
            <? $pictures =  ($form_values['media']['pictures']); ?>
            <? if(!empty($pictures )) : ?>
            <ul>
              <? $i=1 ; foreach($pictures as $pic): ?>
              <li <? if($i == 1): ?> style="display:block" <? endif; ?>><a <? if($i == 1): ?> class="active" <? endif; ?> href="<? print $pic["urls"]['800'] ; ?>"><img src="<? print $pic["urls"]['128'] ; ?>" alt="" /></a></li>
              <? $i++; endforeach; ?>
            </ul>
            <? endif;  ?>
            <script type="text/javascript">
	$(document).ready(function(){
		$("#more_images").click(function(){
			var up_length = $(".input_Up").length;
            if(up_length<=2){
    			var first_up = $("#more_f input:first");
    			$("#more_f").append("<br><br><input class='input_Up' name='picture_' type='file'>");
    			$("#more_f input:last").attr("name", "picture_" + up_length);
            }
		});
	});
</script>
            <div id="more_f" style="padding-bottom:10px">
              <input class="input_Up" name="picture_" type="file">
            </div>
            <a style="font:bold 12px Arial;color#456;text-decoration:none" href="javascript:;" id="more_images"><img src="<?php print_the_static_files_url() ; ?>admin/icons/silk/picture_add.png" style="padding-right:7px;position:relative;top:2px"  border="0" alt=" " />Добави Още Снимки</a> </div>
          <input name="save" class="log" type="submit" value="Запази" style="border:none">
        </div>
      </form>
      <script type="text/javascript" src="<? print TEMPLATE_URL; ?>public/js/jquery.validate.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
            $("#postform").validate();
      if($("input[name='content_title']").val().length!=''){
        $("#categories_lists, #categories_lists div, #ThePostHider").show();
      }
        });
      </script>
      <? endif; ?>
    </div>
  </div>
  <? require (ACTIVE_TEMPLATE_DIR.'users/right_sidebar.php') ?>
</div>
</div>
