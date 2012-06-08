<? include 'header.php' ?>
                <address id="phone">CALL NOW 1.877.255.3713</address>
                <div style="c"></div>
                <a href="#" id="logo">Water For Life</a>
                <ul id="nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">Products</a></li>
                  <li><a href="#">NEWS</a></li>
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Resouce</a></li>
                  <li><a href="#">AfiliateS</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
                <div id="home_head" style="height: auto">
                    <div id="in-banner" class="about-baner">
                        <script type="text/javascript">
                            $(function(){
                                FLIR.replace(document.getElementById('subscribe-label'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'14' }));
                            })
                        </script>
                        <div id="banner-bar">
                           <h2 class="white-title">About Us</h2>
                           <form id="subscribe-form" action="#" method="post">
                                <label for="subscribe-input" id="subscribe-label">Subscribe Newsletter</label>
                                <div>
                                    <input type="text" id="subscribe-input" value="Type your e-mail here"
                                      onfocus="if(this.value=='Type your e-mail here'){this.value=''};this.className='focus'"
                                      onblur="if(this.value==''){this.value='Type your e-mail here'};this.className=''"
                                     />
                                </div>
                                 <input type="submit" id="subscribe-submit" value="" />
                           </form>
                        </div>
                    </div><!-- /in-banner -->
                </div><!-- /home_head -->

            </div><!-- /#header -->

            <div id="content" class="gradient_top content-inner">
               <ul class="breadcrumb">
                 <li><a href="#">Home</a></li>
                 <li><a href="#">Current Page</a></li>
               </ul>
               <div style="height: 40px;"><!--  --></div>

               <div id="main">
                   <h2 class="blue-title">Picture Gallery</h2>
                   <div class="gradient_top" style="padding-bottom: 20px">
                      <div id="gallery">
                        <div id="vision_wrap" style="background-image: url(img/demo/gal1_big.jpg);"></div>
                        <span id="coll_loading" style="display: none;"><!--  --></span>
                          <div id="slides" class="">
                          		<span id="slides_left">FW</span>
                                <span id="slides_right">FF</span>
                              <div id="slider">
                                   <a class="active" style="background-image: url(img/demo/gal1_small.jpg);" href="img/demo/gal1_big.jpg"></a>
                                   <a style="background-image: url(img/demo/gal2_small.jpg);" href="img/demo/gal2_big.jpg"></a>
                                   <a style="background-image: url(http://web1.hry.nic.in/phharyana/Images/water.jpg);" href="http://web1.hry.nic.in/phharyana/Images/water.jpg"></a>
                                   <a style="background-image: url(http://psdblog.worldbank.org/photos/uncategorized/2008/06/23/water.jpeg);" href="http://psdblog.worldbank.org/photos/uncategorized/2008/06/23/water.jpeg"></a>
                                   <a style="background-image: url(http://www.azwater.gov/azdwr/statewideplanning/Drought/images/faucet.jpg);" href="http://www.azwater.gov/azdwr/statewideplanning/Drought/images/faucet.jpg"></a>
                                   <a style="background-image: url(http://www.unece.org/press/pr2009/09env_p19/water.B.jpg);" href="http://www.unece.org/press/pr2009/09env_p19/water.B.jpg"></a>
                              </div>

                              <script type="text/javascript">
                                function slides(){

                                    var curr=$("#slider").scrollLeft();
                                    if($("#slides").hasClass("gright")){
                                        $("#slider").scrollLeft(curr + 4);
                                    }
                                    if($("#slides").hasClass("gleft")){
                                        $("#slider").scrollLeft(curr - 4);
                                    }

                                }
                                setInterval("slides()", "10");

                                function play(){
                                	if($("#gallery").hasClass("play")){
										if($("#slider a.active").next().length>0){
                                           $("#slider a.active").next().click();
										   var active_index=parseFloat($("#slider a.active").attr("rel"));
										   var active_left = active_index*12 + active_index*128;
										   if($(".scrolling").length>0){}
										   else{
                                           	$("#slider").animate({scrollLeft:active_left});
										   }

										}
                                        else{
                                          $("#slider a:first").click();

                                          if($(".scrolling").length>0){}
										   else{
                                           	$("#slider").animate({scrollLeft:0});
										   }
										}
									}
								}
								setInterval("play()", 4500)

								$(document).ready(function(){
                                    var paues = new Image();
                                    paues.src=imgurl + "pause.jpg";


                                    $("#start_play").click(function(){
                                        $("#gallery").toggleClass("play");
                                     if($(this).hasClass("startPlay")){
                                       $(this).removeClass("startPlay");
                                       $(this).addClass("pausePlay");
                                     }
                                     else{
                                        $(this).removeClass("pausePlay");
                                       $(this).addClass("startPlay");
                                     }

									});
									var a_slides=document.getElementById('slider').getElementsByTagName('a');
									for(var i=0;i<a_slides.length;i++){
                                        a_slides[i].rel = i;
									}
								})

                              </script>
                          </div><!-- /slides -->
                      </div><!-- /gallery -->
                      <br />
                      <a href="javascript:;" id="start_play" class="startPlay">Play automatic slideshow</a>
                      <br />
                   </div><!-- /gradient_top -->

                   <div class="gradient_top cblock" style="padding-bottom: 100px">
                    <h2 class="blue-title">See more of gallery section</h2>
                    <ul class="icon-list see-more">
                        <li><a href="#">Korea and Italy 2009 pictures gallery</a></li>
                        <li><a href="#">Ed Begley Event Photos</a></li>
                        <li><a href="#">Pictures from.......</a></li>
                    </ul>
                   </div>

               </div><!-- /#main -->

               <div id="sidebar">
                    <ul class="side-nav">
                       <li><a href="#">Company History</a></li>
                       <li><a href="#">Videos</a></li>
                       <li><a href="#">Picture Gallery</a></li>
                       <li><a href="#">About KYK</a></li>
                       <li><a href="#">Certifications</a></li>
                       <li><a href="#">Testimonials</a></li>
                       <li><a href="#">Press kit</a></li>
                       <li><a href="#">Contact Us</a></li>
                       <li><a href="#">Subscribe</a></li>
                    </ul>
                    <a href="#" class="siderss">Subscribe for RSS</a>
               </div><!-- /#sidebar -->




























            </div><!-- /#content -->
<? include 'footer.php' ?>