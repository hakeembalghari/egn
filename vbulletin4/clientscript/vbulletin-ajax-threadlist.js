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
var vB_ThreadTitle_Editor=null;if(AJAX_Compatible&&(typeof vb_disable_ajax=="undefined"||vb_disable_ajax<2)){vB_XHTML_Ready.subscribe(function(){vB_AJAX_Threadlist_Init("threadlist")})}function vB_AJAX_Threadlist_Init(C){if(!YAHOO.util.Dom.get(C)||!AJAX_Compatible||(typeof (vb_disable_ajax)!="undefined"&&vb_disable_ajax>=2)){return }var D=YAHOO.util.Dom.getElementsByClassName("threadbit","li",C);for(var B=0;B<D.length;B++){if(D[B].id.match(/^thread_/)&&YAHOO.util.Dom.hasClass(D[B],"title_editable")){YAHOO.util.Event.on(D[B],"dblclick",vB_AJAX_ThreadList_Events.prototype.threadtitle_doubleclick);var A=YAHOO.util.Dom.getElementsByClassName("threadstatus","a",D[B]);if(A.length>0){A[0].style.cursor=pointer_cursor;YAHOO.util.Event.on(A[0],"dblclick",vB_AJAX_ThreadList_Events.prototype.threadicon_doubleclick)}}}}function vB_AJAX_OpenClose(A){this.statuslink=A;this.threadbit=false;if(!this.threadbit){this.threadbit=YAHOO.util.Dom.getAncestorByClassName(this.statuslink,"threadbit");this.threadid=this.threadbit.id.substr(this.threadbit.id.lastIndexOf("_")+1)}this.closed=YAHOO.util.Dom.hasClass(this.threadbit,"lock");this.toggle=function(){YAHOO.util.Connect.asyncRequest("POST",fetch_ajax_url("ajax.php?do=updatethreadopen&t="+this.threadid),{success:this.handle_ajax_response,failure:vBulletin_AJAX_Error_Handler,timeout:vB_Default_Timeout,scope:this},SESSIONURL+"securitytoken="+SECURITYTOKEN+"&do=updatethreadopen&t="+this.threadid+"&open="+this.closed)};this.handle_ajax_response=function(C){if(C.responseXML){var B=C.responseXML.getElementsByTagName("status")[0].firstChild.nodeValue;if("closed"==B){YAHOO.util.Dom.addClass(this.threadbit,"lock");this.closed=true}else{if("open"==B){YAHOO.util.Dom.removeClass(this.threadbit,"lock");this.closed=false}}}};this.toggle()}function vB_AJAX_TitleEdit(A){this.obj=A;this.threadid=this.obj.id.substr(this.obj.id.lastIndexOf("_")+1);this.linkobj=fetch_object("thread_title_"+this.threadid);this.container=this.linkobj.parentNode;this.prefixobj=fetch_object("thread_prefix_"+this.threadid);this.prefix_offset=(this.prefixobj?this.prefixobj.offsetWidth+2*input_padding+7:0);this.input_max_width=this.container.offsetWidth-this.prefix_offset;this.input_min_width=(250>this.input_max_width)?this.input_max_width:250;this.input_width=this.linkobj.offsetWidth-this.prefix_offset;if(this.input_width>this.input_max_width){this.input_width=(this.input_max_width>this.input_min_width)?this.input_max_width:this.input_min_width}else{this.input_width=(this.input_width>this.input_min_width)?this.input_width:this.input_min_width}this.editobj=null;this.xml_sender=null;this.origtitle="";this.editstate=false;this.progress_image=new Image();this.progress_image.src=IMGDIR_MISC+"/11x11progress.gif";this.edit=function(){if(this.editstate==false){this.inputobj=document.createElement("input");this.inputobj.type="text";this.inputobj.size=50;this.inputobj.maxLength=((typeof (titlemaxchars)=="number"&&titlemaxchars>0)?titlemaxchars:85);this.inputobj.style.width=this.input_width+"px";this.inputobj.className="textbox";this.inputobj.value=PHP.unhtmlspecialchars(this.linkobj.innerHTML);this.inputobj.title=this.inputobj.value;this.inputobj.onblur=vB_AJAX_ThreadList_Events.prototype.titleinput_onblur;this.inputobj.onkeypress=vB_AJAX_ThreadList_Events.prototype.titleinput_onkeypress;this.editobj=this.container.insertBefore(this.inputobj,this.linkobj);this.editobj.select();this.origtitle=this.linkobj.innerHTML;this.linkobj.style.display="none";this.editstate=true}};this.restore=function(){if(this.editstate==true){if(this.editobj.value!=this.origtitle){this.container.appendChild(this.progress_image);this.save(this.editobj.value)}else{this.linkobj.innerHTML=this.editobj.value}this.container.removeChild(this.editobj);this.linkobj.style.display="";this.editstate=false;this.obj=null}};this.save=function(B){YAHOO.util.Connect.asyncRequest("POST",fetch_ajax_url("ajax.php?do=updatethreadtitle&t="+this.threadid),{success:this.handle_ajax_response,timeout:vB_Default_Timeout,scope:this},SESSIONURL+"securitytoken="+SECURITYTOKEN+"&do=updatethreadtitle&t="+this.threadid+"&title="+PHP.urlencode(B))};this.handle_ajax_response=function(B){if(B.responseXML){this.linkobj.innerHTML=B.responseXML.getElementsByTagName("linkhtml")[0].firstChild.nodeValue;this.linkobj.href=B.responseXML.getElementsByTagName("linkhref")[0].firstChild.nodeValue}this.container.removeChild(this.progress_image);vB_ThreadTitle_Editor.obj=null};this.edit()}function vB_AJAX_ThreadList_Events(){}vB_AJAX_ThreadList_Events.prototype.threadtitle_doubleclick=function(A){if(vB_ThreadTitle_Editor&&vB_ThreadTitle_Editor.obj==this){return false}else{try{vB_ThreadTitle_Editor.restore()}catch(A){}vB_ThreadTitle_Editor=new vB_AJAX_TitleEdit(this)}};vB_AJAX_ThreadList_Events.prototype.threadicon_doubleclick=function(A){YAHOO.util.Event.stopPropagation(A);openclose=new vB_AJAX_OpenClose(this)};vB_AJAX_ThreadList_Events.prototype.titleinput_onblur=function(A){vB_ThreadTitle_Editor.restore()};vB_AJAX_ThreadList_Events.prototype.titleinput_onkeypress=function(A){A=A?A:window.event;switch(A.keyCode){case 13:vB_ThreadTitle_Editor.inputobj.blur();return false;case 27:vB_ThreadTitle_Editor.inputobj.value=vB_ThreadTitle_Editor.origtitle;vB_ThreadTitle_Editor.inputobj.blur();return true}};