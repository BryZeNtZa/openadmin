/**
 * Project : OLYMPIA KIT.
 * File Author : BryZe NtZa
 * File Description : notifications module clients side functions
 * Date : June 2018.
 * */
 
var NOTIFSXHR	  = null;
var NOTIFSTIMERON = true; //Mettre à false pour arreter la boucle infinie des notifications
var NOTIFSTIMEOUT = 5000; //Intervalle de temps pour la boucle des notifications

var NTFOFFSET = 0;
var NTFMAX = 100;

var arrayNotifs = [];
var indexNotif = 0; 
function getUserNotifications(){
	
	console.log("FECTHING NEW NOTIFICATIONS...");
	
	if(!NOTIFSTIMERON) return;
	
	NOTIFSXHR = $.ajax({type: "GET", url: "index.php?module=notifications&controller=userNotifications", dataType: "json", data: {offset: NTFOFFSET, max: NTFMAX }});
	NOTIFSXHR.done(function(blockJSON){
		
		NOTIFSXHR = null;

		if( blockJSON.length && blockJSON.length > 0 ) {
			$("#notif-n-holder").text( parseInt($("#notif-n-holder").text()) + 1 );
			
			var hmtlBock = '';
			
			$.each(blockJSON, function(i, notif){
				arrayNotifs.push(notif);
				hmtlBock = 
				'<div class="col theme-b app-notif" onclick="loadAdherantsNotifs(' + indexNotif +' )" >'+
					'<div class="col-md-2" >'+
						'<img src="www/img/personnal.png" />'+
					'</div>'+
					'<div class="col-md-10" >'+
						'<div style="font-weight: bold;">' + notif.titre + '</div>'+
						'<div style="font-weight: normal;">' + notif.message + '</div>'+
						'<div style="font-weight: normal; font-size: 9px; text-align: right">' + notif.date_auto + '</div>'+
					'</div>'+
				'</div>';
				indexNotif++;
			});
			
			$("#notifs-container .marquer-lus").after(hmtlBock);
			refreshNotifToolTip();

		}
		
		NTFOFFSET += NTFMAX;

		if(NOTIFSTIMERON) setTimeout(getUserNotifications, NOTIFSTIMEOUT);
		
	});
	
	NOTIFSXHR.error(function(e){ 
		if(NOTIFSTIMERON) setTimeout(getUserNotifications, NOTIFSTIMEOUT);
		console.log("RETRIEVING LAST MESSAGES ERROR : "+e.responseText);
	});	
}

function setNotificationsVu(type){
	$.ajax({type: "GET", url: "index.php?module=notifications&controller=setNotificationsVues", dataType: "json", data:{}})
	.done(function(notifs){ }).error(function(e){  console.log("CAN'T SET MESSAGES SEEN : "+e.responseText);});	
}

function stopNotifsLoop(){
	NOTIFSTIMERON = false;
	if( NOTIFSXHR != null ) NOTIFSXHR.abort();
}

function refreshNotifToolTip() {
	$(".notif-n-holder")
	 .click(function(){
		$("#notif-n-holder").text("0");
	 })
	 .tooltipster({
		contentCloning: false,
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
}

function loadAdherantsNotifs(i) {
	var notif = arrayNotifs[i];
	loadDialog("index.php?module=notifications&controller=loadAdherantsNotifs&list_inscriptions="+notif.list_inscriptions+"&list_adherants="+notif.list_adherants+"&list_frais="+notif.list_frais, notif.message, null, 700);
}