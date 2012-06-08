<?php
/*
type: layout
name: Articles layout
description: Articles site layout




*/

?>
<?php include "header.php" ?>
        <div id="home_head" style="height: auto">
          <div id="in-banner" class="news-baner">
            <script type="text/javascript">
                            $(function(){
                                    FLIR.replace(document.getElementById('subscribe-label'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'14' }));
                            })
                        </script>
            <div id="banner-bar">
              <h2 class="white-title">Blog</h2>
              <? include "subscribe_form.php" ?>
            </div>
          </div>
          <!-- /in-banner -->
        </div>
        <? if(!empty($post)) : ?>
        <?php include "dealers_articles_read.php" ?>
        <? else : ?>
        
        <?php  include "dealers_articles_list.php" ?>
        <? endif; ?>
        <?php include "footer.php" ?>
