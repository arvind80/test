/*  Docs:

    .required;
    .required-email;

*/


//check empty
function require(the_form){
    the_form.find(".required").each(function(){
      if($(this).val()=="" || $(this).val()==$(this).attr("title")){
        $(this).addClass("error");
      }
      else{
        $(this).removeClass("error");
      }
    });
}

//check email
function checkMail(the_form){
      the_form.find(".required-email").each(function(){
          var thismail = $(this);
          var thismailval = $(this).val();
          var regexmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

          if (regexmail.test(thismailval)){
              thismail.removeClass("error")
          }
          else{
             thismail.addClass("error")
          }
    })
}


// EXTERNALS:
//captcha
function captha(){
    numbs = Math.round(Math.random()*100000);
    numb = numbs.toString();
     for(var ic=0;ic<numb.length;ic++){
       var c1html = $("#c1").html();
       $("#c1").html(c1html + "<strong>" + numb.charAt(ic)+ "</strong>");
       //$("#c1").html("<img src='http://omnitom.com/facelift/generate.php?text=" + numb + "' />");
     }
}
$("#captchaimage, #captchaimage span").bind("mousemove mousedown click dblclick", function(){
  return false;
})

function checkCaptcha(){

    if($("#captcha input").val()!=numb){
        $("#captcha input").addClass("error");
    }
    else{
       $("#captcha input").removeClass("error");
    }
}




$(document).ready(function(){
  captha();
$("form.validate").submit(function(){
    oform = $(this);
    var valid=true;


    require(oform);

    checkMail(oform);

    checkCaptcha();


    //Final check
    if(oform.find(".error").length>0){
        oform.addClass("error");
        valid=false;
    }
    else{
        oform.removeClass("error");
        valid=true;
    }
    oform.addClass("submitet");

  return valid;
});




// Custom keyUp


$("form.validate .required").bind("keyup blur", function(){
    if($(this).parents("form").hasClass("submitet")){
      if($(this).val()=="" || $(this).val()==$(this).attr("title")){
        $(this).addClass("error");
      }
      else{
        $(this).removeClass("error");
      }
    }
});

$("form.validate .required-email").bind("keyup blur", function(){
    if($(this).parents("form").hasClass("submitet")){
      var thismail = $(this);
      var thismailval = $(this).val();
      var regexmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      if (regexmail.test(thismailval)){
          thismail.removeClass("error")
      }
      else{
         thismail.addClass("error")
      }
    }
});

$("#captcha input").bind("keyup blur", function(){
    if($(this).parents("form").hasClass("submitet")){
        checkCaptcha()
    }
  });
});