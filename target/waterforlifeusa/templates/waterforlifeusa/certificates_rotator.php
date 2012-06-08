<script type="text/javascript">
   function certificatesrotator(){
          var embed = document.createElement('embed');
              embed.setAttribute("type", "application/x-shockwave-flash");
              embed.setAttribute("src", "<? print TEMPLATE_URL; ?>js/jw/imagerotator.swf");
              embed.setAttribute("id", "flashIntro");
              embed.setAttribute("width", "100%");
              embed.setAttribute("height", "100%");
              embed.setAttribute("wmode", "transparent");
              embed.setAttribute("allowscriptaccess", "always");
              embed.setAttribute("allowfullscreen", "false");
              embed.setAttribute("flashvars", "file=<? print TEMPLATE_URL; ?>js/jw/logos.xml&transition=fade&shownavigation=false&overstretch=true&shuffle=false&rotatetime=6");
              document.getElementById('certificatesrotator').insertBefore(embed, document.getElementById('certificatesrotator').firstChild);
  }
  $(document).ready(function(){

       certificatesrotator();

  });
</script>
 <h2 class="title" style="padding: 10px 0 0 0">Certifications</h2>
<div id="certificatesrotator">
    <div id="certificatesrotatoroverlay" onclick="window.location.href='<? print site_url('certificates'); ?>'">&nbsp;</div>
</div>