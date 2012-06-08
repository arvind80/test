<?php
/*
type: layout
name: affiliates us page layout
description: affiliates us page layout




*/

?>
<? $the_section_layout = 'affiliates' ;  ?>
<?php include "header.php" ?>
        <div id="home_head" style="height: auto">
          <div id="in-banner" class="about-baner">
            <script type="text/javascript">
                            $(function(){
                                    FLIR.replace(document.getElementById('subscribe-label'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'14' }));
                            })
                        </script>
            <div id="banner-bar">
              <h2 class="white-title"><? print $page['content_title'] ?></h2>
              <? /*
          <form id="subscribe-form" action="#" method="post">
            <label for="subscribe-input" id="subscribe-label">Subscribe Newsletter</label>
            <div>
              <input type="text" id="subscribe-input" value="Type your e-mail here"
                                      onfocus="if(this.value=='Type your e-mail here'){this.value=''};this.className='focus'"
                                      onblur="if(this.value==''){this.value='Type your e-mail here'};this.className=''"
                                     />
            </div>
            <input type="submit" id="subscribe-submit" value="" />
          </form>
          */ ?>
              <span id="log-reg">
              <? if(strval($user_session['is_logged'] ) == 'yes'):  ?>
              <? $user_data = $this->users_model->getUserById ( $user_session ['user_id'] );   ?>
              <? //   var_dump($user_data); ?>
              Hello, <? print $user_data['username'] ;  ?> (<a style="text-decoration:underline" href="<? print site_url('users/user_action:exit'); ?>">Exit</a>)
              <? //var_dump($shipping_service = $this->session->userdata ( 'user' )) ; ?>
              <? else :  ?>
              <a href="<? print site_url('aff/affiliates/login.php'); ?>" class="<? if($user_action == 'login') : ?> active<? endif; ?>">Login</a> <a href="<? print site_url('aff/affiliates/signup.php'); ?>" class="<? if($user_action == 'register') : ?> active<? endif; ?>">Register</a>
              <? endif; ?>
              </span> </div>
          </div>
          <!-- /in-banner -->
        </div>
        <!-- /home_head -->
        <div id="content" class="gradient_top content-inner">
          <? if($no_breadcrumb_navigation == false): ?>
          <? print $this->content_model->getBreadcrumbsByURLAndPrintThem(); ?>
          <? endif; ?>
          <div style="height: 40px;">
            <!--  -->
          </div>
          <div id="main">
            <h2 class="blue-title-normal"><? print $page['content_title'] ?></h2>
            <div class="richtext"> <? print html_entity_decode($page['content_body']); ?> </div>
          </div>
          
          <!-- /main -->
          <?  include(ACTIVE_TEMPLATE_DIR.'affiliates_sidebar.php') ;  ?>
          <!-- /#sidebar -->
          <div class="clear"></div>
        </div>
        <!-- /#content -->
        <?php include "footer.php" ?>