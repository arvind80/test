    <?
    $banners = array();
    $banner = array();
    $banner['img'] = TEMPLATE_URL. 'img/bottom/distributor.jpg';
    $banner['link'] = $this->content_model->getContentURLByIdAndCache(7);
    $banners[] = $banner;


    $banner = array();
    $banner['img'] = TEMPLATE_URL. 'img/bottom/get1_new.jpg';
    $banner['link'] = $this->content_model->getContentURLByIdAndCache(2);
    $banners[] = $banner;


    $banner = array();
    $banner['img'] = TEMPLATE_URL. 'img/bottom/get2_new.jpg';
    $banner['link'] = $this->content_model->getContentURLByIdAndCache(2);
    $banners[] = $banner;

//    $banner = array();
//    $banner['img'] = TEMPLATE_URL. 'img/bottom/get3.jpg';
//    $banner['link'] = $this->content_model->getContentURLByIdAndCache(2);
//    $banners[] = $banner;

    shuffle($banners);
    $banner = $banners[0];

    ?>

<a href="<? print $banner['link'] ?> "><img src="<? print $banner['img'] ?>" alt="" /></a>
 <br /><br />