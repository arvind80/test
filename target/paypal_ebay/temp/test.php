<?php
function save_image($url,$img)
{
	file_put_contents($img,file_get_contents($url));	
}

save_image('http://www.x.com/sites/default/files/BannerAds_350x200_v1.jpg','../images/test.jpg');
?>