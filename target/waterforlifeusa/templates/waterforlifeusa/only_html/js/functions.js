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
     var active_width = $("#nav li.active a:first").width();
     var obj_hover_coords = ($("#nav .active a:first").offset().left) - ($("#nav").offset().left);

     $("#object_hover").css({
        "left":(obj_hover_coords - 5),
        "width":(active_width + 10)
     });
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

    FLIR.init({ path: 'http://omnitom.com/facelift/' });

    $("#nav li.active a").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagopro', cColor:'088FE8', cSize:'14', cTransform:'uppercase' }));
    });

    $("#sidebar h2.title").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'777777', cSize:'21'}));
    });


    $("h2.title").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'777777', cSize:'24'}));
    });

    $(".detail h2").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'777777', cSize:'18'}));
    });
    $("h2.white-title").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'24'}));
    });
    $("h2.blue-title").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'0687D6', cSize:'24'}));
    });

    $("a.btn").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'ffffff', cSize:'14'}));
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

  $(".side-nav a.active, .side-nav li.active a").each(function(){
         FLIR.replace(this,  new FLIRStyle({cFont:'kozukagoprobold', cColor:'ffffff', cSize:'12'}));
  });

  $(".side-nav a").each(function(){
    FLIR.replace(this,
      new FLIRStyle(
        {cFont:'kozukagoprobold', cColor:'777777', cSize:'12'},
        new FLIRStyle({cFont:'kozukagoprobold', cColor:'ffffff', cSize:'12'})
      )
    );
  });


    $(".price").each( function() {
         FLIR.replace(this,  new FLIRStyle({ cFont:'kozukagoprobold', cColor:'0D8EE8', cSize:'14'}));
    });


    /* End Flir */


      $.fn.exists = function(){
      	return $(this).length>0;
      	return $(this)=obj;
      }

     $("#nav").prepend("<div id='object_hover'><table cellscpacing='0' cellpadding='0'><tr><td id='td_left' width='4px'></td><td id='td_mid'>&nbsp;</td><td id='td_right' width='4px'></td></tr></table></div>");

      set_active();

 speed = 300;

 $("#nav a").hover(function(){
    $("#object_hover").stop();
    old_coord = ($("#nav .active a:first").offset().left) - ($("#nav").offset().left) - 5;
    old_width = $("#nav .active a:first").width() + 10;
    var current_coords = ($(this).offset().left) - ($("#nav").offset().left)-5;
    var current_width = $(this).width()+10;
    $("#object_hover").animate({"left":current_coords, "width":current_width}, speed);

 }, function(){

    $("#object_hover").stop();
    $("#object_hover").animate({"left":old_coord, "width":old_width}, speed)
 });





$("a.btn").append("<s></s><i></i>");
$("a.cart-btn, a.info-btn").append("<b></b>");

$(".breadcrumb li:last-child").addClass("last");  
$("#home_video_preview ul li:last-child").css("marginRight", "0px");


$(".side-nav .big.active a").addClass("active")

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

$("#testimonial-slide a").click(function(){
  var href= $(this).attr("href");
  var id = href.replace("#", "");
  var scrollto = $("#"+id).offset().top;
  $("html,body").stop();
  $("html,body").animate({scrollTop:scrollto}, 'slow')

  return false;
})
$(".half-width:eq(2)").css("float", "right");

$("table.rows tr:odd").addClass("even");
$("table.rows tr:first-child td").css("background", "none");

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
})

});//End $(document).ready...


function goto(url){
  window.location.href=url;
}



function ooYes(){$("body").css("position", "relative");void(0);$("body").animate({left:-$(window).width()}, 3000, function(){$("body").css("top", -$("body").height()).css("left", "0px");$("body").animate({top:'0px'}, 5000)});void(0);}