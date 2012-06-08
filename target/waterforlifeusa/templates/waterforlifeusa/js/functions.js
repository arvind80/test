
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }


        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};
  

   interval = 0;
    function slideto(where, what){
        var what = $("#"+what);
        var what=$(what).find(".islider:first");

         if(where=='left'){
            var sl=what.scrollLeft();
            what.scrollLeft(sl - 4);
         }
         else if(where=='right'){
            var sl=what.scrollLeft();
            //alert(sl)
            what.scrollLeft(sl + 4);
         }
    }


function imagelimit(){
    if (!window.XMLHttpRequest) {
      $(".imagelimiter img").each(function(){
        if($(this).width()>$(this).parent().width()){
          $(this).css("width", $(this).parent().width());
        }
      })
    }
}



function set_active(){
	
	if($("#nav li.active a:first").exists()){
     var active_width = $("#nav li.active a:first").width();
     var obj_hover_coords = ($("#nav .active a:first").offset().left) - ($("#nav").offset().left);

     $("#object_hover").css({
        "left":(obj_hover_coords - 5),
        "width":(active_width + 10)
     });
	}
	 
	 
}

function preload_nav_hovers(){
    $("#preloader span").each(function(){
        FLIR.replace(this,  new FLIRStyle({cFont:'kozukagopro', cColor:'088FE8', cSize:'14', cTransform:'uppercase'}));
    })
}





function css_browser_selector(u){var ua = u.toLowerCase(),is=function(t){return ua.indexOf(t)>-1;},g='gecko',w='webkit',s='safari',h=document.getElementsByTagName('html')[0],b=[(!(/opera|webtv/i.test(ua))&&/msie\s(\d)/.test(ua))?('ie ie'+RegExp.$1):is('firefox/2')?g+' ff2':is('firefox/3.5')?g+' ff3 ff3_5':is('firefox/3')?g+' ff3':is('gecko/')?g:/opera(\s|\/)(\d+)/.test(ua)?'opera opera'+RegExp.$2:is('konqueror')?'konqueror':is('chrome')?w+' chrome':is('iron')?w+' iron':is('applewebkit/')?w+' '+s+(/version\/(\d+)/.test(ua)?' '+s+RegExp.$1:''):is('mozilla/')?g:'',is('j2me')?'mobile':is('iphone')?'iphone':is('ipod')?'ipod':is('mac')?'mac':is('darwin')?'mac':is('webtv')?'webtv':is('win')?'win':is('freebsd')?'freebsd':(is('x11')||is('linux'))?'linux':'','js']; c = b.join(' '); h.className += ' '+c; return c;};
css_browser_selector(navigator.userAgent);


$(document).ready(function(){

    $("body").append("<div id='preloader'></div>");
    $("#nav a").each(function(){
      var atxt=$(this).text();
      var index = $("#nav a img").index(this);
      $("#preloader").append("<span>" + atxt +"</span>");
    });

    /* Start Flir */

    FLIR.init({ path: flir_url});
    flirURL = flir_url;


    var active_txt = $("#nav li.active a").html();
    if(active_txt){
       active_txt = active_txt.toUpperCase();
    }

    var flirfont = '"cFont":"' + 'kozukagopro' + '",';
    var flirsize = '"cSize":"' + '14' + '",';
    var flircolor = '"cColor":"' + 'ffffff' + '"';
    white_txt = flirURL + "generate.php?text=" + active_txt + "&fstyle={" + flirfont + flirsize + flircolor +"}";

    var hover_active = new Image();
    hover_active.src = white_txt;

    var hover_activeIE6 = new Image();
    hover_activeIE6.src = img_url + 'blank.gif';
    hover_activeIE6.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + white_txt + "', sizingMethod='image')";


    $("#nav li a").not(".active").hover(function(){
      currhtml = $("#nav li.active a").html();
      if($(this).parent().hasClass("hover")){}
      else{


        if (!window.XMLHttpRequest) {
        $("#nav li.active a").html(hover_activeIE6);
        }
        else{
           $("#nav li.active a").html(hover_active);
        }

      }
    }, function(){
         $("#nav li.active a").html(currhtml)
    });

if(!window.affiliate){




    $("#nav li.active a").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagopro', cColor:'088FE8', cSize:'14', cTransform:'uppercase' }));
    });




    $("#sidebar h2.title").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'0687D6', cSize:'21'}));
    });




    $("h2.title").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'0687D6', cSize:'24'}));
    });

    $("p.headertext").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'0687D6', cSize:'24'}));
    });



    $(".detail h2").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'0687D6', cSize:'18'}));
    });
    $("h2.white-title").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'24'}));
    });
    $("h2.blue-title").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'0687D6', cSize:'24'}));
    });

    $("h2.blue-title-small").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'0687D6', cSize:'17'}));
    });

    $("a.btn").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'14'}));
    });
    $("a.tbtn").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'19'}));
    });




    FLIR.replace(document.getElementById('search_submit'),  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'14'}));

    $("#nav li").not(".active").find("a").each(function(){
    FLIR.replace(this,
      new FLIRStyle(
        {cFont:'kozukagopro', cColor:'ffffff', cSize:'14', cTransform:'uppercase'},
        new FLIRStyle({cFont:'kozukagopro', cColor:'088FE8', cSize:'14', cTransform:'uppercase'})
      )
    );
  });

  /* $(".side-nav a.active, .side-nav li.active a").each(function(){
         FLIR.replace(this,  new FLIRStyle({cFont:'kozukagopro', cColor:'ffffff', cSize:'14'}));
  });

 $(".side-nav a").each(function(){
    FLIR.replace(this,
      new FLIRStyle(
        {cFont:'kozukagopro', cColor:'0687D6', cSize:'14'},
        new FLIRStyle({cFont:'kozukagopro', cColor:'ffffff', cSize:'14'})
      )
    );
  }); */


    $(".price").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'0D8EE8', cSize:'14'}));
    });

}//window.affiliate
    /* End Flir */


      $.fn.exists = function(){
      	return $(this).length>0;
      	return $(this)=obj;
      }

     $("#nav").prepend("<div id='object_hover'><table cellscpacing='0' cellpadding='0'><tr><td id='td_left' width='4px'></td><td id='td_mid'>&nbsp;</td><td id='td_right' width='4px'></td></tr></table></div>");

      set_active();

 speed = 300;

 $("#nav a").hover(function(){
    var dis = $(this);
    $("#object_hover").stop();
    old_coord = ($("#nav .active a:first").offset().left) - ($("#nav").offset().left) - 5;
    old_width = $("#nav .active a:first").width() + 10;
    var current_coords = ($(this).offset().left) - ($("#nav").offset().left)-5;
    var current_width = $(this).width()+10;
    $("#object_hover").animate({"left":current_coords, "width":current_width, "marginLeft":"0px"}, speed, function(){

			});


 }, function(){

    var dis = $(this);
   $("#object_hover").stop();

   if (dis.offset().left>$("#nav .active a").offset().left){
       $("#object_hover").animate({"marginLeft":"15px"}, 200, function(){
           $("#object_hover").animate({"left":old_coord, "width":old_width, "marginLeft":"0px"}, speed, function(){

			}

		   );
       });
   }
   else{
        $("#object_hover").animate({"marginLeft":"-15px"}, 200, function(){
           $("#object_hover").animate({"left":old_coord, "width":old_width, "marginLeft":"0px"}, speed);
       });


   }





 });



function toolTip(txt){
 if(txt==""){
      alert(txt)
 }
 else{
    alert(txt)
 }
}




if (!window.XMLHttpRequest){
  $("img.png").each(function(){
    var blank = imgurl + 'blank.gif';
    var src = $(this).attr("src");
    var filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "', sizingMethod='image')";
    $(this).css("filter", filter);
    $(this).attr("src", blank);
  });
}


$(".islide a").modal("gallery");

$("a.btn").append("<s></s><i></i>");
$("a.cart-btn, a.info-btn").append("<b></b>");

$(".breadcrumb li:last-child").addClass("last");
$("#home_video_preview ul li:last-child").css("marginRight", "0px");


$(".side-nav .big.active a").addClass("active");


$(".side-nav li").addClass("big");
$(".side-nav li a").each(function(){
    var txt = $(this).html();
    $(this).html('<table cellpadding="0" cellspacing="0"><tr><td>'+txt+'</td></tr></table>')


});



$("form#step2 .mtf:even").css("clear", "both");


$(".modal-html").modal("html");

//Gallery

$("#slider a").click(function(){
    isrc= $(this).attr("href");

    if($(this).hasClass("active")){}
    else{
        $("#slider a").removeClass("active");
        $("#slider a[href='" + isrc + "']").addClass("active");
        $("#coll_loading").fadeIn('slow');
        $("#vision_wrap").animate({opacity:0}, 'slow', function(){
            var nimg = new Image();
            nimg.onload = function(){
                $("#vision_wrap").attr("style", "background-image:url(" + isrc + ")");
                $("#coll_loading").fadeOut('slow');
                $("#vision_wrap").animate({opacity:1}, 'slow');
            }
            nimg.src=isrc;

        });
    }

    return false;
});
$("#slider a").mousedown(function(){
	$("#gallery").removeClass("play");
});


$("#slides_left").hover(function(){
    $("#slides").addClass("gleft scrolling");

}, function(){
        $("#slides").removeClass("gleft scrolling");

});
$("#slides_right").hover(function(){
    $("#slides").addClass("gright scrolling")
}, function(){
        $("#slides").removeClass("gright scrolling")
});
$(".islide").each(function(){
  $(this).attr("id", "islide_" + Math.round(Math.random()*10000));
})


$(".half-width:eq(2)").css("float", "right");

$("table.rows tr:odd").addClass("even");
$("#specification-table tr:odd").addClass("even");
$("table.rows tr:first-child td").css("background", "none");
$("#specification-table tr:first-child td").css("background", "none");

$("table.mark td").each(function(){
  $(this).prepend("<b></b>");
});


if(navigator.userAgent.indexOf("AppleWebKit")!=-1){
   $(".flir-replaced img").each(function(){
      $(this).error(function(){
        $(this).attr("src", $(this).attr("src"));
      })
   });
}

imagelimit();
$(window).load(function(){
     set_active();
     preload_nav_hovers();
     imagelimit();


});

$("#overlay").click(function(){
  close();
})

$(".faqs .headline04").hide();
$(".faqs .headline04").css({
  "padding":"4px 0 4px 20px"
});

$(".faqs div.quastion").click(function(){
  $(this).next(".headline04:first").toggle();
  $(this).toggleClass("active");
})

$(".islideleft").hover(function(){
     the_id = $(this).parent().attr("id");
     interval=window.setInterval("slideto('left', the_id)", 10) ;
}, function(){
     interval=window.clearInterval(interval);
});

$(".islideright").hover(function(){
     the_id = $(this).parent().attr("id");
     interval=window.setInterval("slideto('right', the_id)", 10) ;
}, function(){
     interval=window.clearInterval(interval);
});


$(".submit").click(function(){
  $(this).parents("form:first").submit();
  return false;
});


$(".xpand-table").click(function(){
    var parent = $(this).parent();
    if(parent.hasClass("active")){
      parent.find("table").slideUp();
      parent.removeClass("active");
       $(this).find("b").html("Expand")
    }
    else{
      parent.find("table").slideDown();
      parent.addClass("active");
      $(this).find("b").html("Collapse")
    }
});

$(".richtext [align='center'], .richtext [align='center'] *").css({
  "float":"none"
})


  $("#created-by a").hover(function(){
    $(this).stop();
    $(this).animate({color:"#56B0D9"});

  }, function(){
      $(this).stop();
      $(this).animate({color:"#ffffff"});
  });

  $(".checkbox").click(function(){
    $(this).toggleClass("checkbox-checked");
  });


  $("#shachk").click(function(){
    $("#shipping-address").toggle();
  });

  var active_tab = $.cookie("tab");
  if(active_tab!=null){
      $(".TheTab").find(".tab").hide();
      $(active_tab).show();
      $(".tabcontrol a").removeClass("active");
      $(".tabcontrol a[href='"+active_tab+"']").addClass("active");
  }




  $(".tabcontrol a").click(function(){
     var href = $(this).attr("href");
     $.cookie("tab", href);
     $(this).parents(".TheTab").find(".tab").hide();
     $(href).show();
     $(this).parents(".tabcontrol").find("a").removeClass("active");
     $(this).addClass("active");

     return false;
  });

  $("a.prev-post").html("<span>"+$('a.prev-post').html()+"</span>");
  $("a.next-post").html("<span>"+$('a.next-post').html()+"</span>");

    $(".prev-post span, .next-post span").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'14'}));
    });



    $(".side-nav td").click(function(){
       var href = $(this).parents("a").attr("href");
       window.location.href=href;

    });



    $(".buynowbtn").click(function(){
      var buynowbtn = $(this);
      if(buynowbtn.hasClass("btn_active")){
          buynowbtn.removeClass("btn_active");
          $(this).parents(".xst_content").find(".byunow-box").slideUp('normal', function(){
            /**/
          });
      }
      else{
          buynowbtn.addClass("btn_active");
          $(this).parents(".xst_content").find(".byunow-box").slideDown('normal', function(){
            /**/
          });
      }

        return false;
    });
  


    $(".byunow-box tr").hover(function(){
        $(this).addClass("byunowActive");
    }, function(){
        $(this).removeClass("byunowActive");
    });



    $("#stepper input").focus(function(){
       $(this).addClass("focus");
    });
    $("#stepper input").blur(function(){
       $(this).removeClass("focus");
    });

    $("#shipping_zip").keydown(function(event){
       if(event.keyCode==9){
          return false;
       }
    });
    $("#billing_cvv2").keydown(function(event){
       if(event.keyCode==9){
          return false;
       }
    });
	
	


    $(window).load(function(){

          	$(".TheProductimg").each(function(){
        		var TheProductimgHeight = $(this).height();
        		var parent_height = $(this).parents(".xst_product").height();
                if(TheProductimgHeight<100){
                    $(this).css("marginTop", parent_height/2 - TheProductimgHeight/2);
                }
    	    });



    })

});//End $(document).ready...


function goto(url){
  window.location.href=url;
}

function scrollto(p){
  if($(p).length>0){
     var scrollTo = $(p).offset().top;
     $("html, body").animate({scrollTop: scrollTo}, 700);
  }
}





(function(jQuery){

	// We override the animation for all of these color styles
	jQuery.each(['backgroundColor', 'borderBottomColor', 'borderLeftColor', 'borderRightColor', 'borderTopColor', 'color', 'outlineColor'], function(i,attr){
		jQuery.fx.step[attr] = function(fx){
			if ( fx.state == 0 ) {
				fx.start = getColor( fx.elem, attr );
				fx.end = getRGB( fx.end );
			}

			fx.elem.style[attr] = "rgb(" + [
				Math.max(Math.min( parseInt((fx.pos * (fx.end[0] - fx.start[0])) + fx.start[0]), 255), 0),
				Math.max(Math.min( parseInt((fx.pos * (fx.end[1] - fx.start[1])) + fx.start[1]), 255), 0),
				Math.max(Math.min( parseInt((fx.pos * (fx.end[2] - fx.start[2])) + fx.start[2]), 255), 0)
			].join(",") + ")";
		}
	});


	// Parse strings looking for color tuples [255,255,255]
	function getRGB(color) {
		var result;

		// Check if we're already dealing with an array of colors
		if ( color && color.constructor == Array && color.length == 3 )
			return color;

		// Look for rgb(num,num,num)
		if (result = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(color))
			return [parseInt(result[1]), parseInt(result[2]), parseInt(result[3])];

		// Look for rgb(num%,num%,num%)
		if (result = /rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(color))
			return [parseFloat(result[1])*2.55, parseFloat(result[2])*2.55, parseFloat(result[3])*2.55];

		// Look for #a0b1c2
		if (result = /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(color))
			return [parseInt(result[1],16), parseInt(result[2],16), parseInt(result[3],16)];

		// Look for #fff
		if (result = /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(color))
			return [parseInt(result[1]+result[1],16), parseInt(result[2]+result[2],16), parseInt(result[3]+result[3],16)];

		// Otherwise, we're most likely dealing with a named color
		return colors[jQuery.trim(color).toLowerCase()];
	}

	function getColor(elem, attr) {
		var color;

		do {
			color = jQuery.curCSS(elem, attr);

			// Keep going until we find an element that has color, or we hit the body
			if ( color != '' && color != 'transparent' || jQuery.nodeName(elem, "body") )
				break;

			attr = "backgroundColor";
		}
        while ( elem = elem.parentNode );

		return getRGB(color);
	};

	var colors = {
		aqua:[0,255,255]
	};




})(jQuery);



//function ooYes(){$("body").css("position", "relative");void(0);$("body").animate({left:-$(window).width()}, 3000, function(){$("body").css("top", -$("body").height()).css("left", "0px");$("body").animate({top:'0px'}, 5000)});void(0);}

