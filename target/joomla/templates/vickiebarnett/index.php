<?php
/**
 * @version                $Id: index.php 21518 2011-06-10 21:38:12Z chdemko $
 * @package                Joomla.Site
 * @subpackage  Templates.vickiebarnett
 * @copyright        Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license                GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// check modules
$showRightColumn        = ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$showbottom                        = ($this->countModules('position-9') or $this->countModules('position-10') or $this->countModules('position-11'));
$showleft                        = ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));

if ($showRightColumn==0 and $showleft==0) {
        $showno = 0;
}

JHtml::_('behavior.framework', true);

// get params
$color              = $this->params->get('templatecolor');
$logo               = $this->params->get('logo');
$navposition        = $this->params->get('navposition');
$app                = JFactory::getApplication();
$doc        = JFactory::getDocument();
$templateparams     = $app->getTemplate(true)->params;

$doc->addScript($this->baseurl.'/templates/vickiebarnett/javascript/md_stylechanger.js', 'text/javascript', true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

                <jdoc:include type="head" />
                <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/vickiebarnett/css/style.css" type="text/css" />

                <!--[if lte IE 6]>
                <link href="<?php echo $this->baseurl ?>/templates/vickiebarnett/css/ieonly.css" rel="stylesheet" type="text/css" />

                <?php if ($color=="personal") : ?>
                <style type="text/css">
                #line
                {      width:98% ;
                }
                .logoheader
                {
                        height:200px;

                }
                #header ul.menu
                {
                display:block !important;
                      width:98.2% ;


                }
                 </style>
                <?php endif;  ?>
                <![endif]-->
                <!--[if IE 7]>
                        <link href="<?php echo $this->baseurl ?>/templates/vickiebarnett/css/ie7only.css" rel="stylesheet" type="text/css" />
                <![endif]-->
                <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/vickiebarnett/javascript/hide.js"></script>
                <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/vickiebarnett/javascript/jquery-1.7.1.min.js"></script>

                <script type="text/javascript">
                        var big ='<?php echo (int)$this->params->get('wrapperLarge');?>%';
                        var small='<?php echo (int)$this->params->get('wrapperSmall'); ?>%';
                        var altopen='<?php echo JText::_('TPL_BEEZ2_ALTOPEN',true); ?>';
                        var altclose='<?php echo JText::_('TPL_BEEZ2_ALTCLOSE',true); ?>';
                        var bildauf='<?php echo $this->baseurl ?>/templates/vickiebarnett/images/plus.png';
                        var bildzu='<?php echo $this->baseurl ?>/templates/vickiebarnett/images/minus.png';
                        var rightopen='<?php echo JText::_('TPL_BEEZ2_TEXTRIGHTOPEN',true); ?>';
                        var rightclose='<?php echo JText::_('TPL_BEEZ2_TEXTRIGHTCLOSE'); ?>';
                        var fontSizeTitle='<?php echo JText::_('TPL_BEEZ2_FONTSIZE'); ?>';
                        var bigger='<?php echo JText::_('TPL_BEEZ2_BIGGER'); ?>';
                        var reset='<?php echo JText::_('TPL_BEEZ2_RESET'); ?>';
                        var smaller='<?php echo JText::_('TPL_BEEZ2_SMALLER'); ?>';
                        var biggerTitle='<?php echo JText::_('TPL_BEEZ2_INCREASE_SIZE'); ?>';
                        var resetTitle='<?php echo JText::_('TPL_BEEZ2_REVERT_STYLES_TO_DEFAULT'); ?>';
                        var smallerTitle='<?php echo JText::_('TPL_BEEZ2_DECREASE_SIZE'); ?>';
                </script>
                <script type="text/javascript">
          function slideSlider(obj){
            var listItem = $(obj);
            var liPos = $('div.banner_txt li').index(listItem);
            $('div.banner_txt li').css('display', 'none');
            $('div.banner_txt li').removeClass('active');
            $('div.banner_txt li').eq(liPos).fadeIn('slow');
            $('div.banner_txt li').eq(liPos).addClass('active');
            $('li.slider-button').removeClass('active');
            $('li.slider-button').eq(liPos).addClass('active');
          }

          function justslideSlider(obj){
            slideSlider(obj);
            var t=setTimeout("autoSlideSlider()",3000);
          }

          function autoSlideSlider(obj){
            if(obj == "firstTime"){
              var currentSlide = $("div.banner_txt li.active");
            }else{
              var liLength = $("div.banner_txt li.active").next("li").length;
              if(liLength > 0){
                var currentSlide = $("div.banner_txt li.active").next();
              }else{
                var currentSlide = $("div.banner_txt li").first();
              }
            }
            justslideSlider(currentSlide);
          }
          
          $(document).ready(function(){
            $("div.banner_txt li").first().addClass("first");
            $("div.banner_txt li").first().addClass("active");
            $("div.banner_txt li:last-child").addClass("last");
            autoSlideSlider("firstTime");
            
            $("li.slider-button a").click(function(){
              var listItem = $(this).parent();
              var liPos = $('li.slider-button').index(listItem);
              $('div.banner_txt li').css('display', 'none');
              $('div.banner_txt li').eq(liPos).fadeIn('slow');
              $('li.slider-button').removeClass('active');
              $(this).parent().addClass('active');
              $('div.banner_txt li').removeClass('active');
              $('div.banner_txt li').eq(liPos).addClass('active');
            });

		$("div.navigation ul li:nth-child(6)").css('display', 'none');
		$("div.module_content").css('display', 'block');
		$("#contribute_btn").click(function(){
			var amount = $("#amount").val();
			var email = $("#email").val();
			var first_name = $("#first_name").val();
			var last_name = $("#last_name").val();
			//alert(amount + email + first_name + last_name);
			location.href = "http://vickiebarnett.kindlebit.biz/index.php?option=com_helloworld&amp;view=updhelloworld&amp;Itemid=444&amp;amount="+ amount +"&amp;email="+ email +"&amp;first_name="+ first_name +"&amp;last_name="+ last_name;
			alert(url);
			return false;
		});
          });
        </script>
</head>
<body>
<div id="trans_bg">
    <div id="mainframe">
        <div class="frame">
            <div class="main_header">
               <div class="logo"><a href="<?php echo $this->baseurl; ?>/index.php?option=com_content&amp;view=article&amp;id=72&amp;Itemid=464"><img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/logo.png" alt="logo goes here" /></a></div> 
                <div class="navigation">
          <jdoc:include type="modules" name="position-1" />
                </div>
            </div>
            
            <div class="main_banner">
              <div class="banner_txt">
              <ul>
          <li>
            <img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/ban_txt1.png" alt="The change we need, The voice we deserve..." />
          </li>
          <li style="display:none;">
            <img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/ban_txt2.png" alt="The change we need, The voice we deserve..." />
          </li>
          <li style="display:none;">
            <img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/ban_txt3.png" alt="The change we need, The voice we deserve..." />
          </li>
          <li style="display:none;">
            <img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/ban_txt4.png" alt="The change we need, The voice we deserve..." />
          </li>
          <li style="display:none;">
            <img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/ban_txt5.png" alt="The change we need, The voice we deserve..." />
          </li>
          </ul>
        </div>

                <div class="banner_nav">
                  <ul>
                      <li class="slider-button active"><a href="javascript::void">1</a></li>
                        <li class="slider-button"><a href="javascript::void">2</a></li>
                        <li class="slider-button"><a href="javascript::void">3</a></li>
                        <li class="slider-button"><a href="javascript::void">4</a></li>
                        <li class="slider-button"><a href="javascript::void">5</a></li>
                    </ul>
                </div>
            </div>    
            
            <div class="main_content">
              <div class="t_cont_box">
                    <jdoc:include type="component" />
                </div>
		<?php //if(strpos($_SERVER['PHP_SELF'], 'home') === false){ ?>
		<?php if(($_GET['id']=='70' && $_GET['Itemid']=='467')){ ?>

                <div class="b_cont_box">
                	<div class="bot_grey_box">
                    	
                    	<div class="bot_grey_t">
                        	<div class="bot_grey_b">
                            	<div class="bot_grey_m">
					<div class="icon_box"><img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/icon_bot_l.png" alt="make contibution" /></div>
                                	<h2>Make a Contribution</h2>
                                	<form action="<?php echo $this->baseurl; ?>/index.php?option=com_helloworld&amp;view=updhelloworld&amp;Itemid=444&amp;" method="get" name="contribution_form" id="contribution_form">
										<div class="contri_form">
											<ul>
												<li>
													<label>Amount</label>
													<input type="text" name="amount" id="amount" />
												</li>
												<li>
													<label>Email</label>
													<input type="text" name="email" id="email" />
												</li>
												<li>
													<label>First Name</label>
													<input type="text" name="first_name" id="first_name" />
												</li>
												<li>
													<label>Last Name</label>
													<input type="text" name="last_name" id="last_name" />
												</li>
											</ul>
                                        
                                        <div class="btn_box">
                                        	<input type="button" class="btn_bg" name="contribute" id="contribute_btn" value="Contribute" />
                                        </div>
                                    </div>
                                   </form >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php }else{ ?>

                <div class="b_cont_box">
                    <div class="bot_grey_box grey_box_right">
                    	
                    	<div class="bot_grey_t">
                        	<div class="bot_grey_b">
                            	<div class="bot_grey_m">
				<div class="icon_box"><img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/icon_bot_r.png" alt="Volunteer" /></div>
                                	<h2>Volunteer</h2>
                                    <div class="cont_box">
										<jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

            </div>                    
        </div>
    </div>
</div>
<div id="footer_bg">
  <div id="foot_center">
      <div class="foot_frame">
          <div class="f_social_box">
              <ul>
                  <li><a target="_blank" href="https://twitter.com/Vickie4StateRep"><img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/icon_social_t.png" alt="twitter" /></a></li>
                    <li><a target="_blank" href="http://www.facebook.com/pages/Dr-Vickie-Barnett-for-State-Representative/111969442229496?created"><img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/icon_social_f.png" alt="facebook" /></a></li>
                    <!--<li><a target="_blank" href="http://www.youtube.com/user/vickieforstaterep?feature=mhee"><img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/icon_social_y.png" alt="youtube" /></a></li>-->
                </ul>
            </div> 
            <div class="foot_left">
        <jdoc:include type="modules" name="position-7"  style="beezDivision" headerLevel="3" />
              <div class="icon_box"><img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/icon_mail.png" alt="Stay Updated" /></div>
              <div class="icon_box"><img src="<?php echo $this->baseurl ?>/templates/vickiebarnett/images/icon_mail.png" alt="Stay Updated" /></div>
            </div>
            <div class="foot_right">
              <p>copyrights 2011 Paid for and authorized by Vote for Dr. Vickie Barnett Campaign.<br />
Voice 817-360-0020 | Fax 817-548-1986 | Email: <a href="mailto:info@vickiebarnett.com">info@vickiebarnett.com</a> | P.O. Box 152636 Arlington, TX 76015</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>

