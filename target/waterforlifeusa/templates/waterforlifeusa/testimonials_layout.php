<?php
/*
type: layout
name: About us page layout
description: About us page layout




*/

?>
<? $the_section_layout = 'testimonials'; ?>
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
              <?php include "subscribe_form.php" ?>
            </div>
          </div>
          <!-- /in-banner -->
        </div>
        <!-- /home_head -->
        <? if(!empty($post)) : ?>
        <?php include "articles_read.php" ?>
        <? else : ?>
        <?php include "articles_list.php" ?>
        <? endif; ?>
        <?php include "footer.php" ?>
