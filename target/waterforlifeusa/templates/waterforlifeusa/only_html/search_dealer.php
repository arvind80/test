<? include 'header.php' ?>
                <address id="phone">CALL NOW 1.877.255.3713</address>
                <div style="c"></div>
                <a href="#" id="logo">Water For Life</a>
                <ul id="nav">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Products</a></li>
                  <li><a href="#">NEWS</a></li>
                  <li class="active"><a href="#">About Us</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Resouce</a></li>
                  <li><a href="#">AfiliateS</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
                <div id="home_head" style="height: auto">
                    <div id="in-banner" class="searchdealer-baner">
                        <script type="text/javascript">
                            $(function(){
                                    FLIR.replace(document.getElementById('subscribe-label'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'14' }));
                                    FLIR.replace(document.getElementById('search-dealer-title'),  new FLIRStyle({ cFont:'kozukagopro', cColor:'ffffff', cSize:'24' }));
                            })
                        </script>
                        <h1 id="search-dealer-title">Find the nearest dealer on the map</h1>
                    </div><!-- /in-banner -->
                </div><!-- /home_head -->

            </div><!-- /#header -->

            <div id="content" class="gradient_top content-inner">
               <ul class="breadcrumb">
                 <li><a href="#">Home</a></li>
                 <li><a href="#">Current Page</a></li>
               </ul>
               <div style="height: 40px;"><!--  --></div>

               <div id="google-map">

                   <iframe width="880" height="370" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=usa+new+york&amp;sll=36.5626,-119.421387&amp;sspn=10.018618,23.269043&amp;g=usa+california&amp;ie=UTF8&amp;ll=40.741274,-73.905888&amp;spn=0.024061,0.076389&amp;z=14&amp;output=embed"></iframe>

               </div><!-- /google-map -->

              <p style="padding: 12px 0;">Please type your zip code or address in the box bellow and we will show you the location of the nearest distributor.</p>

              <form method="post" action="#" id="search_dealer">
                <div id="search_dealer_input">
                    <input type="text" value="Enter your address here"
                        onfocus="if(this.value=='Enter your address here'){this.value=''}"
                        onblur="if(this.value==''){this.value='Enter your address here'}"
                     />
                </div>
                <input type="submit" value="" id="search_dealer_submit" />

              </form>

                <br />
              <h2 class="blue-title" style="padding: 12px 0;">Dealers details</h2>
             <br />

             <div class="gradient_top cblock" id="dealer_details">

             <address>
              <strong>John Smith </strong>  <br />
              Dealer adress:<br />
              <br />
              Water For Life USA, Beverly Hills, CA 90213 <br />
              Office phone: 001 (310) 878 9051 <br />
            </address>

            <address>
              <strong>John Smith </strong>  <br />
              Dealer adress:<br />
             <br />
              Water For Life USA, Beverly Hills, CA 90213 <br />
              Office phone: 001 (310) 878 9051 <br />
            </address>

             </div>


            </div><!-- /#content -->

<? include 'footer.php' ?>