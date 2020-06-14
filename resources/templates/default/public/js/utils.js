/**
 * Project : GADAFIC
 * File Author : BryZe NtZa
 * Description : Javascript functions for login page
 * Date : June 2018
 * Copyright XDEV WORKGROUP
 * */

var Util = {
	
	checkValue : function(o) {
		if( $.trim(o.val() )== "" ){
			o.parent().addClass("input-group-danger");
			return false;
		}
		else {
			o.parent().removeClass("input-group-danger");
			return true;
		}
	},

	checkRegexp : function(o, regexp) {
		if( !(regexp.test(o.val())) ){
			o.addClass("input-group-danger");
			return false;
		}
		else{
			o.removeClass("input-group-danger");
			return true;
		}
	},
	
	checkEmail: function(o) {
		return this.checkRegexp(o, this.globals.emailRgx);
	},
	
	loadDialog: function(url,titre,b,h,w,id) {
		
		this.toggleMainWaiter(1,1);
		
		var dlg = (id) ? "#dialog-form"+id : "#dialog-form";
		var zin = (id) ? parseInt(id)*1000 : 1000;
		
		$(dlg).load(url,function(){
			$(this).dialog({
				autoOpen: true,
				height: (h) ? h : ($(window).height()-50),
				width: (w) ? w : ($(window).width()-30),
				position : { my: "center", at: "center", of: window },
				modal: true,
				title: titre,
				draggable: true,
				resizable: true,
				zIndex:zin,
				close: function(){},
				buttons: (b) ? b : [{ text: "Annuler", click: function(){ $(this).dialog("close"); }, icons:{secondary: "ui-icon-close"} }],
			});
			
			this.toggleMainWaiter(1,0);
			
		});
	},

	/* Show or hide waiter while an action is being carried out	*/
	toggleMainWaiter: function (texte, etat) {
	
		if( etat == 1 ){
			switch(texte){
				case 1: msg = DISPLAY_MESSAGES["MSG_CHARGEMENT"]; break;
				case 2: msg = DISPLAY_MESSAGES["MSG_SAUVEGARDE"]; break;
				case 3: msg = DISPLAY_MESSAGES["MSG_SUPPRESSION"]; break;
			}
			
			$(".top-flash-msger").hide();
			$("#top-flash-msger-wait span.text").html(msg).show();
			$("#top-flash-msger-wait").show();
		}
		else{
			$(".top-flash-msger").hide();
		}
	},
	
	showWaiterInside: function (divBlock, w, h) {
		divBlock.html(this.getWaiter(w, h));
	},
	
	/*Function qui empeche la saisie alpha dans un champ reservé aux nombres entiers*/
	isNumeric: function (value) {
		return (/(^\d+$)|(^\d+\.\d+$)/).test (value);
	},

	onlyDigitKeys: function (event) {
		event = event || window.event; 
		var car = String.fromCharCode (event.charCode || event.keyCode); 
		if (event.keyCode == 8){return car;} else {return this.isNumeric (car);} 
	},

	onlyDigitDecimalKeys: function (event) {
		event = event || window.event; 
		var car = String.fromCharCode (event.charCode || event.keyCode);
		if (event.keyCode == 8 || car=="." || car==","){return car;} else {return this.isNumeric (car);} 
	},

	validateForm: function (f) {
	
		var fOK = true;
		f.find(".validate-field").each( function() {
			if( this.hasAttribute("required") )
				fOK = Util.checkValue( $(this) );
			
			if( this.hasAttribute("checkemail") )
				if( $.trim($(this).val()) != "" )
					fOK = Util.checkEmail( $(this) );
		});
	
		return fOK;
	},
	
	getWaiter: function(w, h) {
		
		var waiterString = 	
		'<center>'+
			'<svg width="'+w+'px" height="'+h+'px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-google">'+
				'<g transform="translate(50 50)">'+
					'<g>'+
						'<animateTransform attributeName="transform" type="rotate" calcMode="discrete" values="0;90;180;270;360" keyTimes="0;0.25;0.5;0.75;1" ng-attr-dur="{{config.speed}}s" repeatCount="indefinite" dur="2.5s"/>'+
						'<path ng-attr-d="{{config.d1}}" fill="#009F3C" d="M-50 0A50 50 0 1 0 50 0">'+
						  '<animate attributeName="fill" calcMode="discrete" values="#009F3C;#142587;#7d7e7d;#611FA4;#009F3C" keyTimes="0;0.24;0.49;0.74;0.99" ng-attr-dur="{{config.speed}}s" repeatCount="indefinite" dur="2.5s"/>'+
						'</path>'+
						'<path ng-attr-d="{{config.d2}}" fill="#142587" d="M-50 0A50 50 0 0 1 50 0">'+
						  '<animate attributeName="fill" calcMode="discrete" values="#142587;#7d7e7d;#611FA4;#009F3C;#142587" keyTimes="0;0.25;0.5;0.75;1" ng-attr-dur="{{config.speed}}s" repeatCount="indefinite" dur="2.5s"/>'+
						'</path>'+
						'<path ng-attr-d="{{config.d4}}" stroke="rgb(0, 111, 42)" stroke-width="2" d="M-49 0L49 0">'+
						  '<animate attributeName="stroke" values="#009F3C;rgb(0, 111, 42);rgb(14, 26, 95);#142587;rgb(14, 26, 95);rgb(88, 88, 88);#7d7e7d;rgb(88, 88, 88);rgb(68, 22, 115);#611FA4;rgb(68, 22, 115);rgb(0, 111, 42);#009F3C" keyTimes="0;0.124;0.125;0.25;0.374;0.375;0.5;0.624;0.625;0.75;0.874;0.875;1" ng-attr-dur="{{config.speed}}s" repeatCount="indefinite" dur="2.5s"/>'+
						'</path>'+
						'<g>'+
						  '<path ng-attr-d="{{config.d3}}" fill="rgb(0, 111, 42)" d="M-50 0A50 50 0 0 1 50 0Z">'+
							'<animate attributeName="fill" values="#009F3C;rgb(0, 111, 42);rgb(14, 26, 95);#142587;rgb(14, 26, 95);rgb(88, 88, 88);#7d7e7d;rgb(88, 88, 88);rgb(68, 22, 115);#611FA4;rgb(68, 22, 115);rgb(0, 111, 42);#009F3C" keyTimes="0;0.124;0.125;0.25;0.374;0.375;0.5;0.624;0.625;0.75;0.874;0.875;1" ng-attr-dur="{{config.speed}}s" repeatCount="indefinite" dur="2.5s"/>'+
						 ' </path>'+
						  '<animateTransform attributeName="transform" type="scale" values="1 1;1 0;1 -1;1 1" keyTimes="0;0.5;0.999;1" ng-attr-dur="{{config.speed2}}s" repeatCount="indefinite" dur="0.625s"/>'+
						'</g>'+
					'</g>'+
				'</g>'+
			'</svg>'+
		'</center>';
		
		return waiterString;
	},
	
	globals : {
		isConnecting: false,
		processingRequest: false,
		emailRgx: /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i
	},
};
