/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.2.2 Patch Level 1
|| # ---------------------------------------------------------------- # ||
|| # Copyright �2000-2014 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/
function vB_Facebook(B){if(typeof (FB)!="object"){console.log("Facebook API Load Failure");return }this.config=B;this.ids={fb_usernameid:"facebookusername",fb_passwordid:"facebookpassword",fb_associateid:"facebookassociate",invisibles:[{id:"fb_headerbox"},{id:"fbregbox"}],publishcheckboxid:"fb_dopublish",loginbtns:[{id:"fb_loginbtn"},{id:"fb_regloginbtn"},{id:"fb_getconnected"}]};if(YAHOO.util.Dom.get("facebookassociateform")){this.ids.loginform_id="facebookassociateform";this.ids.loginform_usernameid="vb_login_username";this.ids.loginform_passwordid="vb_login_password"}else{this.ids.loginform_id="navbar_loginform";this.ids.loginform_usernameid="navbar_username";this.ids.loginform_passwordid="navbar_password"}this.loginscope={scope:"email,user_about_me,user_activities,user_birthday,user_interests,user_likes,user_website,user_location,user_work_history"};FB.init({appId:this.get_config("appid"),status:true,cookie:true,xfbml:true,oauth:true});if(typeof (A)=="undefined"){var C=(YAHOO.env.ua.opera>0);var D=(YAHOO.env.ua.webkit>0);var A=((YAHOO.env.ua.ie>0)&&(!C)&&(!D))}if(A){FB.UIServer.setActiveNode=function(F,E){FB.UIServer._active[F.id]=E};FB.UIServer.setLoadedNode=function(F,E){FB.UIServer._loadedNodes[F.id]=E}}if(LOGGEDIN&&this.get_config("connected")){this.prepare_publishtofacebook()}this.register_loginbtns();this.make_visible()}vB_Facebook.prototype.get_config=function(A){if(typeof (this.config)=="undefined"||typeof (this.config[A])=="undefined"){return false}else{return this.config[A]}};vB_Facebook.prototype.register_loginbtns=function(){for(var C=0;C<this.ids.loginbtns.length;C++){var D=YAHOO.util.Dom.get(this.ids.loginbtns[C].id);if(D){YAHOO.util.Event.on(D,"click",this.handle_fbLogin,this,true)}}var B=YAHOO.util.Dom.get(this.ids.fb_usernameid);var E=YAHOO.util.Dom.get(this.ids.fb_passwordid);var A=YAHOO.util.Dom.get(this.ids.fb_associateid);if(B&&E&&A){YAHOO.util.Event.on(A,"click",this.login_and_associate,this,true);this.fb_username_listener=new YAHOO.util.KeyListener(B,{keys:13},{fn:this.handle_associate_keypress,scope:this,correctScope:true});this.fb_username_listener.enable();this.fb_password_listener=new YAHOO.util.KeyListener(E,{keys:13},{fn:this.handle_associate_keypress,scope:this,correctScope:true});this.fb_password_listener.enable()}};vB_Facebook.prototype.make_visible=function(){for(var A=0;A<this.ids.invisibles.length;A++){var B=YAHOO.util.Dom.get(this.ids.invisibles[A].id);if(B){YAHOO.util.Dom.removeClass(B,"hidden")}}};vB_Facebook.prototype.do_fbRedirect=function(){var A=window.top.location.href.replace(/#.*/,"");var B=(window.top.location.search.substring(1)?"&":"?");window.top.location=A+B+"dofbredirect=1"+window.top.location.hash};vB_Facebook.prototype.handle_fbLogin=function(A){YAHOO.util.Event.stopEvent(A);FB.getLoginStatus(function(B){if(B.authResponse){vBfb.do_fbRedirect();return }else{FB.login(function(C){if(C.authResponse){vBfb.do_fbRedirect()}},vBfb.loginscope)}})};vB_Facebook.prototype.handle_associate_keypress=function(B,A){YAHOO.util.Event.preventDefault(A[1]);this.login_and_associate()};vB_Facebook.prototype.login_and_associate=function(){var D=YAHOO.util.Dom.get(this.ids.loginform_id);var A=YAHOO.util.Dom.get(this.ids.loginform_usernameid);var C=YAHOO.util.Dom.get(this.ids.loginform_passwordid);var B=YAHOO.util.Dom.get(this.ids.fb_usernameid);var E=YAHOO.util.Dom.get(this.ids.fb_passwordid);if(A&&B){A.value=B.value}if(C&&E){C.value=E.value}if(D){if(D.onsubmit){D.onsubmit()}D.submit()}};vB_Facebook.prototype.register_logout=function(){FB.logout(vBfb.do_fbRedirect)};vB_Facebook.prototype.prepare_publishtofacebook=function(){var E=YAHOO.util.Dom.get(this.ids.publishcheckboxid);var C=E;while(C&&C.tagName.toLowerCase()!="form"){C=C.parentNode}this.editFormEl=C;if(this.editFormEl){if(this.editFormEl.id=="form_widget_comments"&&E.type!="radio"){this.onSubmitEvent=this.editFormEl.sbutton.onclick;this.editFormEl.sbutton.onclick=null;YAHOO.util.Event.on(this.editFormEl.sbutton,"click",this.check_publishingperms_cmscomment,this,true)}else{this.onSubmitEvent=this.editFormEl.onsubmit;this.editFormEl.onsubmit=null;YAHOO.util.Event.on(this.editFormEl,"submit",this.check_publishingperms,this,true);var B=this.editFormEl.getElementsByTagName("input");for(var D=0;D<B.length;D++){var A=B[D];if(A.type=="submit"||A.type=="image"){YAHOO.util.Event.on(A,"click",this.track_submitbutton,this,true)}}}}};vB_Facebook.prototype.track_submitbutton=function(A){this.btnClicked=YAHOO.util.Event.getTarget(A)};vB_Facebook.prototype.is_pubCbChecked=function(){var A=YAHOO.util.Dom.get(this.ids.publishcheckboxid);return(typeof (A)!="undefined"&&A.checked==1)};vB_Facebook.prototype.check_publishingperms=function(A){YAHOO.util.Event.stopEvent(A);if(this.is_pubCbChecked()&&(this.btnClicked.name=="sbutton"||this.btnClicked.id=="save_btn"||this.btnClicked.id=="apply_btn")){FB.login(function(B){vBfb.handle_submit_override()},{scope:"publish_stream"})}else{this.handle_submit_override()}};vB_Facebook.prototype.check_publishingperms_cmscomment=function(A){if(this.is_pubCbChecked()){FB.login(function(B){vBfb.onSubmitEvent()},{scope:"publish_stream"})}else{this.onSubmitEvent()}};vB_Facebook.prototype.handle_submit_override=function(){if(typeof (this.onSubmitEvent)=="undefined"||!this.onSubmitEvent||this.onSubmitEvent.call(this.editFormEl)){var A=document.createElement("input");A.setAttribute("type","hidden");A.setAttribute("name",this.btnClicked.name);A.setAttribute("value",this.btnClicked.value);this.editFormEl.appendChild(A);this.editFormEl.submit()}};function loadFacebookAPI(C){var A,B="facebook-jssdk";if(document.getElementById(B)){return }A=document.createElement("script");A.id=B;A.async=true;A.src="//connect.facebook.net/"+C+"/all.js";document.getElementsByTagName("head")[0].appendChild(A)};