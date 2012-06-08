<script type="text/javascript" src="<? print TEMPLATE_URL; ?>/js/tablesorter.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $(".wr-numb").each(function(i){

            if(i<99){
              if(i<9){
                $(this).html("00"+(i+1) + ".");
              }
              else{
                 $(this).html("0"+(i+1) + ".");
              }
            }
            else{
               $(this).html((i+1) + ".");
            }
       });
       $(".water-reports a[href$='pdf']").each(function(){
            $(this).parent().before('<td class="wr-type type-pdf"><span>pdf</span></td>');
       });

       $(".water-reports a[href$='doc']").each(function(){
            $(this).parent().before('<td class="wr-type type-doc"><span>doc</span></td>');
       });
       $(".water-reports a[href$='DOC']").each(function(){
            $(this).parent().before('<td class="wr-type type-doc"><span>doc</span></td>');
       });
       $(".water-reports a[href$='rtf']").each(function(){
            $(this).parent().before('<td class="wr-type type-rtf"><span>rtf</span></td>');
       });
       $(".water-reports a[href$='RTF']").each(function(){
            $(this).parent().before('<td class="wr-type type-rtf"><span>rtf</span></td>');
       });
       $(".water-reports a[href$='docx']").each(function(){
            $(this).parent().before('<td class="wr-type type-doc"><span>doc</span></td>');
       });
       $(".water-reports a[href$='html']").each(function(){
            $(this).parent().before('<td class="wr-type type-html"><span>html</span></td>');
       });
       $(".water-reports a[href$='htm']").each(function(){
            $(this).parent().before('<td class="wr-type type-html"><span>html</span></td>');
       });
       $(".water-reports a[href$='xls']").each(function(){
            $(this).parent().before('<td class="wr-type type-xls"><span>xls</span></td>');
       });
       $(".water-reports a[href$='mht']").each(function(){
            $(this).parent().before('<td class="wr-type type-mht"><span>mht</span></td>');
       });


       $(".water-reports th").hover(function(){
         $(this).css("background", "#DAE4F8")
       },function(){
         $(this).css("background", "none")
       })

       $(".water-reports table").tablesorter();

       $('.water-reports td a').each(function(){
          var atitle = $(this).attr("title");
          var atitle_to_lower = atitle.toLowerCase();
          var atitle_to_lower = atitle_to_lower.replace(",", "");
          var atitle_to_lower = atitle_to_lower.replace("-", "");
          $(this).attr("title", atitle_to_lower);
       });
       $("#sort-reports-input").keyup(function(){
          var svalue = $(this).val();
          var svalue = svalue.toLowerCase();
          if(svalue==''||svalue=='Search Reports'){
            $(".water-reports tr").show();
          }
          else{
            $('.water-reports td a').not("a[title*='" + svalue + "']").parents("tr").hide();
            $(".water-reports td a[title*='" + svalue + "']").parents("tr").show();
          }
       });



    });

</script>


<div id="sort-reports">
    <span>
        <input type="text" id="sort-reports-input" value="Search Reports" onfocus="if(this.value=='Search Reports'){this.value=''}" onblur="if(this.value==''){this.value='Search Reports'}" />
    </span>
</div>


<div class="water-reports">
    <table cellpadding="2" cellspacing="0" style="width: 645px;">
        <thead>
              <tr>
                <th>No.</th>
                <th>Type</th>
                <th>Document</th>
              </tr>
        </thead>
        <tbody>

        <?php

$dir = opendir ('userfiles/media/file/water reports/');
    while (false !== ($file = readdir($dir))) {
        if (strpos($file, '.doc',1)||strpos($file, '.docx',1)||strpos($file, '.DOC',1)||strpos($file, '.pdf',1)||strpos($file, '.rtf',1)||strpos($file, '.RTF',1)||strpos($file, '.mht',1)||strpos($file, '.htm',1)||strpos($file, '.html',1)||strpos($file, '.HTML',1)||strpos($file, '.HTM',1)||strpos($file, '.xls',1)) {

            echo '<tr><td class="wr-numb"></td><td><a target="_blank" title="'. $file . '" href="'. site_url(). 'userfiles/media/file/water reports/'. $file .'">'. $file .'</a></td></tr>';
        }
    }
?>


        </tbody>
    </table>
</div>