	
function initSearchField () {
	$("#gadafic-general-searcher")
	 .focus( function(){ $(this).animate({ 'width': '475px' }, 300 ) })
	 .blur( function(){ $(this).animate({ 'width': '200px' }, 300 ) });
}

/*$("#gadafic-general-searcher").bind('keyup', function(event){
	var chaine = $(this).val();
	if(event.keyCode==27){ //TOUCHE ECHAP
		$("#search-results-holder").hide();
	}
	else{
		if($.trim(chaine)==""){
			$("#search-results-holder").hide();
		}
		else{
			$("#search-results-holder").show();
			$("#search-results-holder .loader").show(); 
			$("#search-results-holder .found").hide();
			
			//REQUETE DE RECHERCHE
			$.ajax({type:'GET', url:'index2.php?module=search&action=general_search&chaine='+chaine})
			.done(function(viewHtml){
				$("#search-results-holder .results").html(viewHtml);
			})
			.error(function(e){ 
				$("#search-results-holder .results").html('<div style="cursor:pointer;min-height:20px;color:red" ><img src="images/warning.png" height=20/>&nbsp;ssfsfsd</div>');
			});

		}

	}
});*/
	