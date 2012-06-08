<? 


if (!function_exists('make_jw_player_playlists_from_posts_and_return_url')) {
   
   

 

function make_jw_player_playlists_from_posts_and_return_url($data){
	$CI = & get_instance ();
	if(!empty($data)){
		$rss_items = array();
		foreach ($data as $item){
			$media = false;
			$media = $CI->content_model->mediaGetForContentId($item['id'], 'video'); 
			if(!empty($media)){
			//	p($media);
				$temp = array();
				$temp['title'] = $item['content_title'];
				$temp['description'] = $item['content_description'];
				$temp['link'] = $CI->content_model->contentGetHrefForPostId($item['id']);
				$temp['pubdate'] = $item['updated_on'];
				$temp['file'] = $media['videos'][0]['url'];
				$temp['image'] = $CI->core_model->mediaGetThumbnailForMediaId($media['videos'][0]['id'], '640');
				$rss_items[] = $temp;
			}
			
			
			
		}
		
		
	}
	
	//p($rss_items);
	if(!empty($rss_items)){
		$out = false;
		
		$out = '
		
		<rss version="2.0" 
	xmlns:media="http://search.yahoo.com/mrss/" 
	xmlns:jwplayer="http://developer.longtailvideo.com/trac/wiki/FlashFormats">
	<channel>
		<title>Featured videos</title>
';
		 
		
		foreach ($rss_items as $item){
$out .='
		<item>
			<title>'. $item['title'].'</title>
			<link>'. $item['link'].'</link>
			<image>'. $item['image'].'</image>
			<description>'. $item['description'].'</description>
			 

			<media:group>
				 <media:thumbnail  url="'. $item['image'].'" />
				<media:content url="'. $item['file'].'" />
			</media:group>
		 
		</item>';
		 }
$out .= '
	</channel>

</rss>



		';
		
	} 
	@unlink (ACTIVE_TEMPLATE_DIR.'irss_home.xml');
	@file_put_contents(ACTIVE_TEMPLATE_DIR.'irss_home.xml',$out );
	return TEMPLATE_URL.'irss_home.xml';
	
}



   
   
}  
?>