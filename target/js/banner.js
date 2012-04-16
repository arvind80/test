    $(document).ready(function() {
            $(".fancyvideo").fancybox({
                overlayShow: false,
                frameWidth:800,
                frameHeight:500
            });
        });

	$(document).ready(function(){
		$(".inputbox1").each(function(){
		var origValue = $(this).val(); // Store the original value
		$(this).focus(function(){
			if($(this).val() == origValue) {
				$(this).val('');
			}
		});
		$(this).blur(function(){
			if($(this).val() == '') {
				$(this).val(origValue);
			}
		});
	  });
	});
	
	$(document).ready(function(){
			$("#Forgot_Password_reg").fancybox({
				'overlayShow'	: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'	
			});
		});
		
	window.fbAsyncInit = function() {
				FB.init({
					appId : '226036900747005',
					session : '{$jsonencode}', // don't refetch the session when PHP already has it
					status : true, // check login status
					cookie : true, // enable cookies to allow the server to access the session
					xfbml : true // parse XFBML
				});
			};
			(function() {
				var e = document.createElement('script');
				e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
				e.async = true;
				if( document.getElementById('fb-root') )
					document.getElementById('fb-root').appendChild(e);	
			}());
			// Function to enter the login credentials when user access 
			// **********************************************************
			function fblogin(){
				FB.login(function(response) {
					if (response.session) {
						if (response.perms) {
							FB.api(
							{	
								// Query to get all the albums of the user
								method: 'fql.query',
								query: 'SELECT uid,name,email,first_name,last_name,profile_url,pic_big FROM user WHERE uid='+ response.session.uid
							}
							, function(me){
								// Code for storing the User facebook_id and facebook_access_token in DB
								//**********************************************************************
								//var user_id = <?php echo $_SESSION['sign_up_id']; ?>;
								var uid = response.session.uid;
								var access_token = response.session.access_token;
								$.post('/ajax/checkFacebookuser.php', 
									{
										facebookId:uid,
										accessToken:access_token,
										firstName:me[0].first_name,
										lastName:me[0].last_name,
										profileUrl:me[0].profile_url,
										email:me[0].email,
										facebook_image:me[0].pic_big
									},
									function(data){	
										if(data=='inserted'){
											window.location='/index.php';
										}else if(data=='success'){
											window.location='/index.php';	
										}else{
											alert(data);
										}
									}
									,'');
								//**********************************************************************		
								//window.close();
								//alert(me[0].uid);
								//alert(me[0].name);
								//alert(me[0].email);
								//alert(me[0].first_name);
								//alert(me[0].last_name);
								//alert(me[0].profile_url);
								//alert(response.session.access_token);
							});
							// user is logged in and granted some permissions.
							// perms is a comma separated list of granted permissions
						} else {
							// user is logged in, but did not grant any permissions
						}
					} else {
						// user is not logged in
					}
				},{perms:'read_stream,publish_stream,offline_access,email'});
			} 
			
	function getXMLHTTP() { 
		var xmlhttp=false;	
		try{xmlhttp=new XMLHttpRequest();}
		catch(e){ try{ xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");	}catch(e){try{xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");}		catch(e1){xmlhttp=false;}}}return xmlhttp; 
	}

	function SE(OP,CL){
		if(document.getElementById(CL).style.display=="none"){
		document.getElementById(OP).style.display="none";
		document.getElementById(CL).style.display="inline";}
		else{document.getElementById(CL).style.display="none";
		document.getElementById(OP).style.display="inline";}
	}
			
	function HideShow(id){jQuery('#'+id+'').slideToggle('slow');}	

	function submit_search(){
	    if(document.getElementById('dm_search').value!=''&&document.getElementById('dm_search').value!='Keyword Search'){
		FormName		= document.dmsearch;
		FormName.action	= "search_details.php?dm_search="+document.getElementById('dm_search').value;
		FormName.submit();
		return true;}
		
		else{ alert('Please enter keyword to search.');return false;}
	}
	
	function go_to_facebook(){
		FormName		= document.comment_form;
		FormName.action	= "facebook_comment.php";
		FormName.submit();}
		
	
	function FacebookPopup(){
		var query = "";
		window.open("/facebook_import/examples/example.php" + query,"example","location=0,status=1,scrollbars=1,width=400,height=400");
	} 

	function userlogin(){
		$('a[name=homeLogin]').click();
	}
	
	$(document).ready(function() {	
		stopScroll();
		//select all the a tag with name equal to modal
		$('a[name=modal]').click(function(e) {
			//Cancel the link behavior
			e.preventDefault();
			
			//Get the A tag
			var id = $(this).attr('href');
			
		 	//Get the screen height and width
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		
			//Set heigth and width to mask to fill up the whole screen
			$('#mask').css({'width':maskWidth,'height':maskHeight});
			
			//transition effect		
			$('#mask').fadeIn(500);	
			$('#mask').fadeTo("fast",2);	
		
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
				  
			//Set the popup window to center
			/* $(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);
			 */
			//$(id).css('class','largerView');
			if( id != '#dialog1'&& id != '#dialog2'){
				$(id).css('background-color','#fff');
				$(id).css('border','1px solid #fff');
			}
			
			$(id).css('display','block');
			$(id).css('height','415px');
			$(id).css('left','18%');
			$(id).css('top','13%');
			$(id).css('width','598px');
			
			//transition effect
			$(id).fadeIn(2000); 
			pageScroll();
			//window.scroll(0,50);	
		});
		
		//if close button is clicked
		$('.window .CloseTxt').click(function (e) {
			//Cancel the link behavior
			e.preventDefault();
			stopScroll();
			$('#mask').hide();
			$('.window').hide();
		});

		//if close button is clicked
		$('.window .CloseTxt01').click(function (e) {
			//Cancel the link behavior
			e.preventDefault();
			stopScroll();
			$('#mask').hide();
			$('.window').hide();
			
		});	
		
		$('.window .Closes').click(function (e) {
			//Cancel the link behavior
			e.preventDefault();
			stopScroll();
			$('#mask').hide();
			$('.window').hide();
			
		});	
	/* 	
		//if mask is clicked
		$('#mask').click(function () {
			$(this).hide();
			$('.window').hide();
		});	 */		
	
	});
	
	var scrolldelay;
	function stopScroll() {
    	clearTimeout(scrolldelay);
	}

	function pageScroll() {
    	window.scroll(0,50); // horizontal and vertical scroll increments
    	scrolldelay = setTimeout('pageScroll()',100); // scrolls every 100 milliseconds
	}


	$(document).ready(function(){
			if(getCookie('bannerStatus') == 'hide'){
				$('.TopBanner').hide();
			}
			$('.TopBanner').click(function(){
				$(this).slideUp('slow');
				document.cookie="bannerStatus" + "=" +"hide";
			}); 
	});	
		
	function getCookie(c_name){
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++)
		{
			x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
			y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
			x=x.replace(/^\s+|\s+$/g,"");
			if (x==c_name){
				return unescape(y);
			}
		}	
	} 

	function updatePoll(formObj){
		for(var i=0;i<formObj.elements.length;i++){
			if( formObj.elements[i].checked ){ 
				selectedOption = formObj.elements[i].value;
			} 
		}
		document.getElementById('submitPoll').disabled = true;
		pollId = formObj.elements[4].value;
		$.post(
				'../index.php',
				{ 
					action:'updatePoll',
					option:selectedOption,
					id:pollId
				},
				function(Response){ 
					if( Response == 'true'){
						alert('Poll submitted Successfully');
					}else if( Response == 'joined'){
						alert('Already Contributed!');
					}else{
						alert('Unable to submit the Poll');
					}
					document.getElementById('submitPoll').disabled = false;
					return false;
				}
				,'');			
		return false;
	}
	
	function validation(id) {
		
		Formname = document.poll;
		if(Formname.memberpoll[0].checked=='' && Formname.memberpoll[1].checked=='' && Formname.memberpoll[2].checked=='' && 			Formname.memberpoll[3].checked=='')
		{
			alert("Please choose your answer!");
			return false;
		}
	} 
	
	var currentUrl = window.location;
	
	function checkLogin(url){ 
		
		var usernames = document.getElementById('Name').value;
		var passwords = document.getElementById('Password').value;
		var remember_me = document.getElementById('remember_me_reg').checked;
		if( (usernames == '') || (passwords == '') ){
			alert("Mandatory fields cannot left empty");
			return false;
		}	 
		$.post(
				'../check_login.php',
				{ 
					username:usernames,
					password:passwords,
					remember_me_reg:remember_me
				},
				function(Response){  
					if( Response == 'false' || Response == '' ){  
						document.getElementById('errorResponse').style.display = '';
						document.getElementById('errorResponse').style.color = 'red';
						document.getElementById('errorResponse').style.fontSize = '12px';
						document.getElementById('errorResponse').innerHTML = 'Incorrect Username or Password!';
						return false;
					}else{
							window.top.parent.location.reload();
					}
				}
			,''); 
		return false;  
	}
	
	function checkLogin_SignIn(formObj){
		var usernames = document.getElementById('Name_reg').value;
		var passwords = document.getElementById('Password_reg').value;
		var remember_me = document.getElementById('remember_me_reg1').checked;
		if( (usernames == '') || (passwords == '') ){
			alert("Mandatory fields cannot left empty");
			return false;
		}	 
		$.post(
				'../check_login.php',
				{ 
					username:usernames,
					password:passwords,
					remember_me_reg:remember_me
				},
				function(Response){
					if(Response==""){
						document.getElementById('errorResponse1').style.display = '';
						document.getElementById('errorResponse1').style.color = 'red';
						document.getElementById('errorResponse1').innerHTML = 'Incorrect Username or Password!';
						return false;
					}else{ 
						if(Response=='home'){
						window.location ='../index.php';}
						else if(Response=="success"){
						window.location ='../user_dashboard.php';
						}
					}
				}
			,''); 
		return false;
	}
	function updateVote(videoId,errorDisplayMode){
		if( videoId != '' ){			
			$.post(
				'../index.php',
				{ 
					action:'vote',
					id:videoId
				},
				function(Response){ 	
					var responseId = 'errorResponse'+videoId;
					var value = document.getElementById(videoId).innerHTML; 
					
					if( Response == 'joined'){
						var message = 'Already Voted for Video';
						var colors = 'red';
					}else if( Response == 'true'){
						var message = 'Successfully Voted';
						var colors = 'green';
						value++;
					}else{
						var message = 'Unable to Process the Request';
						var colors = 'red';
					} 
					if( errorDisplayMode == 1 ){
						document.getElementById(videoId).innerHTML = value;
						document.getElementById(responseId).style.display = '';
						document.getElementById(responseId).style.color = colors;
						document.getElementById(responseId).innerHTML = message;
						$(responseId).slideUp("slow");
					}else{ 
						alert(message);
					}			
				}
			,''); 
		}
		return false;		
	}
	
	function submitSubCat(value){ 
		
		var CatId = document.getElementById('catId').value;
		var viewMode = document.getElementById('mode').value;
		if( value != 'null' )
			window.location = '/compete.php?categoryId='+CatId+'&subcatId='+value+'&viewMode='+viewMode;
		else	
			window.location = '/compete.php?categoryId='+CatId+'&viewMode='+viewMode;
	}
	
	var PreviousActiveCont='dashboard';
	function switchCont(hideCont,showCont){
		try {
			if( hideCont == '' ){
				hideCont = PreviousActiveCont;
			}
			document.getElementById(hideCont).style.display = 'none';
			document.getElementById(showCont).style.display = '';
			
			var currentContClass = 'parent_'+showCont;
			var previousContClass = 'parent_'+PreviousActiveCont;
			
			if( document.getElementById(currentContClass) && document.getElementById(previousContClass) ){
				document.getElementById(currentContClass).setAttribute('class','active');
				document.getElementById(previousContClass).setAttribute('class','');
			}
			PreviousActiveCont = showCont;
		} catch(e) {
		
		}		
 	} 
	
	function postComment(userId,userName,profilePic,videoId){
 		if( userId == '' ){
			$('.fancyvideo').click();
			return false;
		}else{
				if( document.getElementById('comment') && document.getElementById('comment').value != '' ){
					document.getElementById('postComment').disabled = 'disabled';
					var commentData = document.getElementById('comment').value;
					$.post(
							'../videoDetail.php',
							{ 
								action:'addcomment',
								v_id:videoId,
								textarea:commentData
							},
							function(Response){ 	
									if( Response == "true"){
										var responseMessage = 'Successfully Added';
									}else if( Response == "false"){
										var responseMessage = 'Already Contributed!';
									}
									document.getElementById('responseMsg').style.display = '';
									document.getElementById('responseMsg').style.color = 'red';
									document.getElementById('responseMsg').innerHTML = responseMessage;
									
									closeCommentCont();
									if( Response == "true" ){ 
										var updateCont = 'comment'+document.getElementById('commentCount').value;
											createCommentSection(updateCont,userName,profilePic,commentData);
										var commentCount = document.getElementById("commentcount").innerHTML;
										commentCount = parseInt(commentCount);
										commentCount++;
										document.getElementById("commentcount").innerHTML = commentCount;
										window.location.reload();
									}									
								}
						,''); 
				}else{ 
					createCommentSection('commentConts',userName,profilePic,'');
				}  
		}
		return false;
	}
	
	var ts;
	function refreshPage(){
		window.location = window.location;
		clearTimeout(ts);
	}
	
	function closeCommentCont(){
		var parentCont = document.getElementById('commentConts');
		var childCont = document.getElementById('addComment');
		var heights = parseInt(parentCont.style.height);
		if( heights >  1 ){
				heights = heights-5;
				var t=setTimeout("closeCommentCont()",50);
				parentCont.style.height = heights+'px'; 
				
		}else{
				//parentCont.removeChild(childCont);
				document.getElementById('cancelLink').style.display='none';
				document.getElementById('remLen11').style.display='none';
				document.getElementById('responseMsg').style.display = 'none';
				clearTimeout(t); 
				try {
					parentCont.removeChild(childCont);
				} catch (e) {
				}
		}
	}
	
	function createCommentSection(parent,userName,profilePic,commentData){
		
		var parentCont = document.getElementById(parent);
			
		var table = document.createElement('table');
		var tr = document.createElement('tr');
			tr.setAttribute("id","addComment");
			tr.setAttribute("style","height:50px");
			
		var td1 = document.createElement('td');
			td1.setAttribute("valign","top");
			if( profilePic != '' )
				td1.innerHTML = '<img src="profile_image/'+profilePic+'" width="35" height="36" border="0"/>';
			else	
				td1.innerHTML = '<img src="profile_image/no-user-image.jpg" width="35" height="36" border="0"/>';
		
		var td = document.createElement('td');
		var contenTable = document.createElement('table');
			var contentRow1 = document.createElement('tr');
			var contentColumn1 = document.createElement('td');
				contentColumn1.innerHTML = userName;
				contentColumn1.setAttribute("style","font-size:12px");
				
				contentRow1.appendChild(contentColumn1); 
				
			var contentRow2 = document.createElement('tr');
			var contentColumn2 = document.createElement('td');	
				
			if( commentData != '' ){
				var commentInput = document.createElement('span'); 
					commentInput.innerHTML = commentData;
				 
 			}else{
				var commentInput = document.createElement('textarea'); 
				commentInput.setAttribute("rows","2");
				commentInput.setAttribute("cols","70");
				commentInput.setAttribute("id","comment");
				commentInput.setAttribute("onkeyup","textCounter(this,'remLen11',100)");
				commentInput.setAttribute("onkeydown","textCounter(this,'remLen11',100)");
 			}			
				contentColumn2.appendChild(commentInput);
				contentRow2.appendChild(contentColumn2);
				
			contenTable.appendChild(contentRow1); 
			contenTable.appendChild(contentRow2); 
			td.appendChild(contenTable); 
			
			tr.appendChild(td1); 
			tr.appendChild(td);		
			table.appendChild(tr);
		 
			parentCont.appendChild(table);
			parentCont.style.display='block';
			incrementHeight();		
			document.getElementById('cancelLink').style.display='block';				
			document.getElementById('remLen11').style.display='block';				
			return false;
	}
	
	function incrementHeight(){ 
		var parentCont = document.getElementById('commentConts');	
		var heights = parseInt(parentCont.style.height);
			if( heights >= 60 ){ 
				clearTimeout(t); 
				
			}else{ 
				heights = heights+5;  
				var t=setTimeout("incrementHeight()",50);
				parentCont.style.height = heights+'px';  
			}
	}
	
	function updateChallenges(competitionIds,userChoices){
		
		if( competitionIds !='' && userChoices != '' ){
			
			$.post(
				'../user_dashboard.php',
				{ 
					action:'updateChallenge',
					videoId:competitionIds,
					userChoice:userChoices
				},
					function(Response){ 
						if( Response == 'true' ){
							alert('Successfully '+userChoices+'ed');
							var rejectId = competitionIds+'1';
							var acceptId = competitionIds+'2';
							
							document.getElementById(rejectId).setAttribute("onclick",'');
							document.getElementById(acceptId).setAttribute("onclick",'');
							//window.location = '/user_dashboard.php?tab=; 
						}
					} 
			,'');  		
		}
		return false;  
	}
	
	var previousActive = 1;
	var pageNum = 1;
	var previousAction ='';
	
	function fetchResult(file,currentElement,actions,maxLimit,recordCount,category,subcategory){
		previousActive = pageNum;
		if( currentElement.title == 'next'){
			pageNum++; 
		}else if( currentElement.title == 'prev'){
			pageNum--; 
		}else{
			pageNum = currentElement.title; 
		}		
		if( pageNum < 0 ){
			pageNum=1;
		}else if( pageNum > maxLimit){
			pageNum = maxLimit;
		} 
		
		var start = (pageNum-1)*recordCount;
		var end = recordCount; 
		
		$.post(
				file,
				{ 
					action:actions, 
					startLimit:start,
					endLimit:end,
					mode:'json',
					cat:category,
					subcat:subcategory
				},
					function(Response){  
						var parent = document.getElementById(actions);
							parent.innerHTML = ''; 
							
						if( actions == 'fetchchallenge' ){
							createChallengeHTML(parent,Response);
						}else if( actions == 'listview' ){
							createListViewHTML(parent,Response);
						}else if( actions == 'viewallevent' ){
							createEventHTML(parent,Response);
						}else{
								var j=1;
								for( var i=0;i<=Response.length;i++){
									var parentCont = document.createElement('div');
										parentCont.setAttribute("class","ChallengerBox");
						
									var imgTag = document.createElement('img');
									try{
										if( Response[i].embed_id != null ){
											var src = "http://img.youtube.com/vi/"+Response[i].embed_id+"/1.jpg";
										}else if( (Response[i].video_image != null) && (Response[i].video_image != '') ){
											var src = "site_videos/"+Response[i].video_image;
										}else{
											var src = "images/icon_video.gif";
										} 
										imgTag.setAttribute("src",src);
										imgTag.setAttribute("width","190px");
										imgTag.setAttribute("height","150px");
							
										var nameCont = 	document.createElement('div');
											nameCont.setAttribute("class","ChallengerHdgTxt");
											nameCont.innerHTML = Response[i].video_name;
											//alert(Response[i].video_name);
								
											parentCont.appendChild(imgTag);
											parentCont.appendChild(nameCont);
											parent.appendChild(parentCont);
										
										if ( j%4 == 0 ){
										
											var clear = document.createElement('div');
												clear.setAttribute("style","float:left;width:100%;height:20px");											
											parent.appendChild(clear);
										
										}								
										j++;
									}catch(e){
									} 
								} 
							}
							if (previousActive == 0 ){
								previousActive = 1 ; 
							}  	
							if( (currentElement.title == 'next') && (pageNum > 10 ) ){	
								incrementPaginate(maxLimit,pageNum,file,currentElement,actions,maxLimit,recordCount);
							}
							 
							document.getElementById(pageNum).setAttribute("class","active");
							document.getElementById(previousActive).setAttribute("class","");
							
					}
			,'json');    
	}
	
	function incrementPaginate(limit,currentPage,file,actions,maxLimit,recordCount){ 
		var parent = document.getElementById("paging");
		if(parent){
			parent.innerHTML = '';
		}
		
		var ul = document.createElement('ul');
		var li = document.createElement('li');
		var anchor = document.createElement('a');
			anchor.setAttribute("href","javascript:void(0);");
			anchor.setAttribute("onclick","fetchResult('"+file+"','this','"+actions+"','"+limit+"','"+recordCount+"','','')");
			anchor.setAttribute("id","prev");
			anchor.setAttribute("title","prev");
			
		var imageTag = document.createElement('img');
			imageTag.setAttribute("src","images/back.jpg");
			imageTag.setAttribute("width","20");
			imageTag.setAttribute("height","18");
		
		anchor.appendChild(imageTag);
		li.appendChild(anchor);
		ul.appendChild(li);
		
		var loopStart = (currentPage-3)+1;	
		if( limit < (currentPage+3) ){			
			var loopEnd = limit;
		}else{
			var loopEnd = currentPage+1;
		}
		
		for(var i=loopStart;i<loopEnd;i++){
			
			var li = document.createElement('li');
			var anchor = document.createElement('a');
				anchor.setAttribute("href","javascript:void(0);");
				anchor.setAttribute("onclick","fetchResult('"+file+"','this','"+actions+"','"+limit+"','"+recordCount+"','','')");
				anchor.setAttribute("id",i);
				anchor.setAttribute("title",i);
			
			var innerText = document.createTextNode(i); 
		
			anchor.appendChild(innerText);
			li.appendChild(anchor);
			ul.appendChild(li);		
		}	
		var li = document.createElement('li');
		var anchor = document.createElement('a');
			anchor.setAttribute("href","javascript:void(0);");
			anchor.setAttribute("onclick","fetchResult('"+file+"','this','"+actions+"','"+limit+"','"+recordCount+"','','')");
			anchor.setAttribute("id","next");
			anchor.setAttribute("title","next");
			
		var imageTag = document.createElement('img');
			imageTag.setAttribute("src","images/forward.jpg");
			imageTag.setAttribute("width","20");
			imageTag.setAttribute("height","18");
		
		anchor.appendChild(imageTag);
		li.appendChild(anchor);
		ul.appendChild(li);
		alert(ul);		
		parent.appendChild(ul);
	}
	
	function createEventHTML(parent,Response){
		var content ='';
		for( var i=0;i<Response.length;i++){	
			content += '<div class="ChallengerBox">';
			if( Response[i].image != '' )
				content += '<div><img src="event_image/resized/s1-'+Response[i].image+'" width="190" height="150" alt="'+Response[i].event_name+'" /></div>';
			else
				content += '<div><img src="images/icon_video.gif" width="190" height="150" alt="'+Response[i].event_name+'" /></div>';
				
			content += '<div class="ChallengerHdgTxt">'+Response[i].event_name+'</div>';
			content += '<span class="EventRow1" style="padding:0"><a href="javascript:void(0);">'+Response[i].event_city+'</a></span>';
			content += '<span class="EventRow2">'+Response[i].event_state+'</span> ';
			content += '<span class="EventRow3">'+Response[i].event_date +' at '+Response[i].event_time+'</span>';
			content += '</div>';
		}
		parent.innerHTML = content;
	}
	
	function createListViewHTML(parent,Response){		 
		var content ='';
		for( var i=0;i<Response.length;i++){	
			content += '<div class="HipHop"><div class="BingBang" style="margin:18px 4px;"><div align="center"><a href="http://www.youtube.com/watch?v='+Response[i].video1.embedId+'" class="fancyvideo"><img src="'+Response[i].video1.image+'" alt="'+Response[i].video1.name+'" width="250" height="200"  /></a></span></div><div class="bingtxt"><a href="videoDetail.php?videoId='+Response[i].video1.video_id+'"><span class="padding_text">'+Response[i].video1.name+'</span></a></div><p class="Bingdetail left_flot">Comments: <span class="blue_sel">'+Response[i].video1.commentCount+'</span> <br />Round Score:'+Response[i].video1.roundscore+'</p><span class="btn_align"><a href="javascript:void(0);"><img src="images/vote_me.png" border="0" alt="" align="top" /></a></span></div><img src="images/vs_img.jpg" class="Vsimg01 pad_new" width="43" height="46" alt="" /><div class="BingBang"  style="margin:18px 4px;"> <div align="center"><a href="http://www.youtube.com/watch?v='+Response[i].video2.embedId+'" class="fancyvideo"><img src="'+Response[i].video2.image+'" width="250" height="200" alt="'+Response[i].video2.name+'" /></a></div><div class="bingtxt"><a href="videoDetail.php?videoId='+Response[i].video2.video_id+'"><span class="padding_text">'+Response[i].video2.name+'</span></a></div><p class="Bingdetail left_flot">Comments: <span class="blue_sel">'+Response[i].video2.commentCount+'</span> <br />Round Score: '+Response[i].video2.roundscore+'</p><span class="btn_align"><a href="javascript:void(0);"><img src="images/vote_me.png" border="0" alt="" align="top" /></a></span></div></div>';
		}
		parent.innerHTML = content;
	}

	
	function createChallengeHTML(parent,Response){
	
		for( var i=0;i<Response.length;i++){
			
			var parentCont = document.createElement('div');
				parentCont.setAttribute("class","ChallengerBox");

			var imgTag = document.createElement('img');
			var src = "http://img.youtube.com/vi/"+Response[i].embed_id+"/1.jpg";
				imgTag.setAttribute("src",src);
				imgTag.setAttribute("width","190px");
				imgTag.setAttribute("height","150px");
	
			var nameCont = 	document.createElement('div');
				nameCont.setAttribute("class","ChallengerHdgTxt");
				nameCont.innerHTML = Response[i].video_name;
			
			var userNameCont = 	document.createElement('div');
				userNameCont.setAttribute("class","ChallengerSubTxt");
				userNameCont.innerHTML = '<div class="ChallengerSubTxt">By: <span class="ChallengerOTxt">'+Response[i].username+'</span><br/>Challenge for: <span class="ChallengerOTxt">'+Response[i].competename+'</span><br/>Challenge on: '+Response[i].competename+'</div><div class="ChallengerBtn"><a id="'+Response[i].video_id+'1" onclick="updateChallenges('+Response[i].video_id+',\'Reject\');"  href="javascript:void(0);"><img src="images/reject.jpg" width="81" height="24" /></a>&nbsp;<a id="'+Response[i].video_id+'1" onclick="updateChallenges('+Response[i].video_id+',\'Accept\');"  href="javascript:void(0);"><img src="images/accept.jpg" width="81" height="24" /></a></div>';
			 
				parentCont.appendChild(imgTag);
				parentCont.appendChild(nameCont);
				parentCont.appendChild(userNameCont);
				parent.appendChild(parentCont);
		} 
	
	}
	
	function viewsubcat(CatId,value){
		window.location = '/viewall.php?mode=comp&category='+CatId+'&subCategory='+value;
	}
	
	function viewwinnersubcat(CatId,value){
		window.location = '/viewall.php?mode=compwinner&category='+CatId+'&subCategory='+value;
	}
	
	function switchImage(currentCat,currentSubCat,mode){
		
		var url = "compete.php?categoryId="+currentCat;
			if( currentSubCat != '' )
				url += "&subcatId="+currentSubCat;
		
			url += "&viewMode="+mode;
			
		window.location = url;
	}
	
	function fetchComment(currentElement,videoId){
		
		var currentCounts = document.getElementById("startCount").innerHTML;
			currentCount = parseInt(currentCounts);
			
		var maxCount = document.getElementById("maxCount").innerHTML;	
			maxCount = parseInt(maxCount);
			
		if( currentElement.title == 'next' ){
			 currentCount++; 				
			if( currentCount > maxCount ){
				return false;
			}
		}else if( currentElement.title == 'prev' ){		
	 		currentCount = parseInt(currentCount)- 2 ;	 	
			if( currentCount < 0 ){
				return false;
			}
		}		
		$.post(
				"../videoDetail.php",
				{ 
					action:"paginateComment",
					currentPage:currentCount,
					videoId:videoId
				},
					function(Response){
						var responseHTML = '';
						for(var i=0;i < Response.length;i++){
							responseHTML += '<div class="post" id="comment"><div class="user">';
							if( Response[i].image != '' ){
								 responseHTML += '<img src="profile_image/'+Response[i].image+'" width="36" height="35" alt="" />';
							}else{	
								responseHTML += '<img src="profile_image/no-user-image.jpg" width="36" height="35" alt="" />';
							} 
							responseHTML += '</div> ';
							responseHTML += '<div class="recent_comm">';
							responseHTML += '<span>'+Response[i].username+'</span><br />';
							responseHTML += '<p>'+Response[i].cmt+'</p>';
							responseHTML += '<div class="post_time"><p>'+Response[i].postedDate+'</p></div></div></div>';
						}  
						document.getElementById("commentCont").innerHTML = responseHTML;
						if( currentCount == 0 ){
							currentCount++;
						}
						document.getElementById("startCount").innerHTML = currentCount;
					}
			,'json');    					
	}
	
	var cssmenuids=["cssmenu1"] //Enter id(s) of CSS Horizontal UL menus, separated by commas
	var csssubmenuoffset=-1 //Offset of submenus from main menu. Default is 0 pixels.

	function createcssmenu2(){
		
		for (var i=0; i<cssmenuids.length; i++){
			if( document.getElementById(cssmenuids[i])){
				var ultags=document.getElementById(cssmenuids[i]).getElementsByTagName("ul")
				for (var t=0; t<ultags.length; t++){
					ultags[t].style.top=ultags[t].parentNode.offsetHeight+csssubmenuoffset+"px"
					var spanref=document.createElement("span")
						spanref.className="arrowdiv"
						spanref.innerHTML="&nbsp;&nbsp;&nbsp;&nbsp;"
						ultags[t].parentNode.getElementsByTagName("a")[0].appendChild(spanref)
						ultags[t].parentNode.onmouseover=function(){
							this.style.zIndex=100
							this.getElementsByTagName("ul")[0].style.visibility="visible"
							this.getElementsByTagName("ul")[0].style.zIndex=0
						}
						ultags[t].parentNode.onmouseout=function(){
							this.style.zIndex=0
							this.getElementsByTagName("ul")[0].style.visibility="hidden"
							this.getElementsByTagName("ul")[0].style.zIndex=100
						}
				}
			}			
		}
	}

	if (window.addEventListener)
		window.addEventListener("load", createcssmenu2, false)
	else if (window.attachEvent)
		window.attachEvent("onload", createcssmenu2)