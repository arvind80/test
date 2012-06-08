<?php
/*
type: layout
name: Default layout
description: default site layout




*/

?>
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
     
    </div>
  </div>
  <!-- /in-banner --> 
</div>
<!-- /home_head -->
<div id="content" class="gradient_top content-inner"> <? print $this->content_model->getBreadcrumbsByURLAndPrintThem(); ?>
  <div style="height: 40px;"><!--  --></div>
  <? if(!empty($subdomain_user) && $subdomain_user['user_information']): ?>
  <?  include(ACTIVE_TEMPLATE_DIR.'about_us_logged.php') ;  ?>
  <? else : ?>
  <div id="main">
    <h2 class="blue-title-normal"><? print $page['content_title'] ?></h2>
    <div class="richtext"> {content} </div>
     
  </div>
  <!-- /main -->
  <?  //include(ACTIVE_TEMPLATE_DIR.'about_us_sidebar.php') ;  ?>
  <!-- /#sidebar -->
  <? endif; ?>
  <div class="clear"></div>
</div>
<!-- /#content -->

<?php include "footer.php" ?>
