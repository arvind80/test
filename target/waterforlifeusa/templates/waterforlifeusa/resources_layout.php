<?php
/*
type: layout
name: About us page layout
description: About us page layout




*/

?>
<? $the_section_layout = 'resources'; ?>
<?php include "header.php" ?>
        <div id="home_head" style="height: auto">
          <div id="in-banner" class="resources-baner">
            <script type="text/javascript">
                            $(function(){
                                    FLIR.replace(document.getElementById('products-baner-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'24' }));
                                    FLIR.replace(document.getElementById('products-baner-sub-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'007AC0', cSize:'16' }));


                            $("#checkout_table th").each(function(){
                                 FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'007AC0', cSize:'14' }));
                            });


                            $("#step2").validate();



                            });
                        </script>
            <div id="products-baner-txt">
             <? print html_entity_decode($page['content_body']); ?>
            </div>
          </div>
          <!-- /in-banner -->
        </div>
        <? if(!empty($post)) : ?>
        <?php include "articles_read.php" ?>
        <? else : ?>
        <?php include "articles_list.php" ?>
        <? endif; ?>
        <?php include "footer.php" ?>
