/**
 * Project : GADAFIC PRO.
 * File Author : BryZe NtZa
 * Description : Javascript functions for login page
 * Date : June 2018.
 * Copyright XDEV WORKGROUP
 * */

var Login = {
	
	GLOBAL : {isConnecting: false, },
	
	handleLoginForm : function(f) {
		
		var obj = this;
		
		f.submit(function(e) {
			
			e.preventDefault();
			
			if (obj.GLOBAL.isConnecting == true) return;
			obj.GLOBAL.isConnecting = true;

			var that = $(this);
			var t = $.trim($("#login-username").val()), n = $.trim($("#login-password").val());

			if( t != "" && n != "" ){

				$.ajax({type: "GET",url: that.attr("action"), data: {lg:t, pw:n} })
				 .done(function(rep){
					if(rep=="success"){
						window.location.reload();
					}
					else{
						obj.ShowMessage(DISPLAY_MESSAGES.MSG_LOGIN_UNKNOWN_USER);
						obj.GLOBAL.isConnecting = false;
					}
				 })
				 .error(function(e){
					obj.ShowMessage( strReplace("_MSG_", e.responseText, DISPLAY_MESSAGES.MSG_LOGIN_ERROR) );
					obj.GLOBAL.isConnecting = false;
				 });
			}
			else{
				obj.ShowMessage(DISPLAY_MESSAGES.MSG_EMPTY_LOGIN_PARAMS);
				obj.GLOBAL.isConnecting = false;
			}
		});
	},

	ShowMessage : function(msg){
		
		var msgHtml = 
		'<div class="alert alert-danger" role="alert" style="margin-top: 50px;">'+
			'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>'+
			'<span class="sr-only">Error:</span>'+
			msg+
		'</div>';
		
		$("#dialog-confirm").html(msgHtml);
		$("#dialog:ui-dialog").dialog("close");
		$("#dialog-confirm").dialog({
			title: DISPLAY_MESSAGES.TTR_LOGIN_FAILED,
			show: { effect: "explode", duration: 200 },
			hide: { effect: "explode", duration: 200 },
			resizable: false,
			draggable: true,
			height:450,
			width:300,
			modal: true,
			buttons:[
				{
					text: DISPLAY_MESSAGES.BTN_CLOSE,
					click: function(){
						$(this).dialog("close");
					},
					icons:{secondary:"ui-icon-close"}
				}
			]
		});
	},

	strReplace : function (search,replace,subject,count){
		var i=0,j=0,temp='',repl='',sl=0,fl=0,f=[].concat(search),r=[].concat(replace),s=subject,ra=Object.prototype.toString.call(r)==='[object Array]',sa=Object.prototype.toString.call(s)==='[object Array]';s=[].concat(s);if(count){this.window[count]=0;}
		for(i=0,sl=s.length;i<sl;i++){if(s[i]===''){continue;}
		for(j=0,fl=f.length;j<fl;j++){temp=s[i]+'';repl=ra?(r[j]!==undefined?r[j]:''):r[0];s[i]=(temp).split(f[j]).join(repl);if(count&&s[i]!==temp){this.window[count]+=(temp.length-s[i].length)/f[j].length;}}}
		return sa?s:s[0];
	},

	setDefaultLanguage : function(id) {
		var obj = this;
		$.ajax({type: "GET",url: "./langues/change.php?id="+id}).done(function(rep){
			window.location.reload();
		}).error(function(e){
			obj.ShowMessage( obj.strReplace("_MSG_", e.responseText, DISPLAY_MESSAGES.MSG_SERVER_ERROR) );
		});
	},

	init : function() {
		
		var sloganSlides = [];

		$("#gadafic-slogan-slides-text div.slogan").each(function(){ sloganSlides.push($(this).html()); });

		var t = new Typed("#gadafic-slogan-slides", {
			strings: sloganSlides,
			typeSpeed: 40,
			backSpeed: 20,
			startDelay: 3000,
			backDelay: 3000,
			smartBackspace: false,
			loop: true
		});

		$(".language-switch-link").tooltipster({
			contentCloning: true,
			animation: "swing",
			delay: 200,
			theme: "tooltipster-noir",
			contentAsHTML: true,
			interactive: true,
			trigger: "click",
			triggerOpen: {
				mouseenter: true
			},
			triggerClose: {
				click: true,
				scroll: true
			}
		});	
		
		this.resizeOverlay();
		this.handleLoginForm($("#login-form"));	
		
	},

	resizeOverlay : function() {
		var navbarHeight = $("#gadafic-main-nav").height();
		var footerHeight = $("#gadafic-xdev-wg-footer").height();
		$("#gadafic-page-overlay").css({"height": (window.height-(navbarHeight+footerHeight))+"px"});
	},

};

$(window).resize(function(){ Login.resizeOverlay(); });

Login.init();
