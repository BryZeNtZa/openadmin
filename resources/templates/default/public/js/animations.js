var numAnimIntervals = [];
var animsDatas = [];

function animateNumberStats(statsContainerId) {		

	$("#"+statsContainerId+" .stat-number").each(function(i, el) {
		
		var statObj   = $(el);
		var numHolder = statObj.find('.num');
		
		var start 	 = parseInt(statObj.attr('data-start'));
		var end 	 = parseInt(statObj.attr('data-end'));
		var delay 	 = parseInt(statObj.attr('data-delay'));
		var duration = parseInt(statObj.attr('data-duration'));
		
		var step = duration/end;
		var counter = start;
		
		animsDatas.push({start: start, end: end, delay: delay, duration: duration, step: step, counter: counter});
		
		if(animsDatas[i].delay==0) {
			
			numAnimIntervals.push(
				
				window.setInterval( 
					
					function () {
						animsDatas[i].counter = animsDatas[i].counter + 1;
						numHolder.text(animsDatas[i].counter);
						if(animsDatas[i].counter >= animsDatas[i].end) { console.log("Object "+i+": "+animsDatas[i].counter+"\n"); window.clearInterval(numAnimIntervals[i]); }
					}, 
					
					animsDatas[i].step
				)
			);
		}
		else {
			window.setTimeout( 
				function() {
					numAnimIntervals.push(
						
						window.setInterval( 
							
							function () {
								animsDatas[i].counter = animsDatas[i].counter + 1;
								numHolder.text(animsDatas[i].counter);
								if(animsDatas[i].counter >= animsDatas[i].end) { console.log("Object "+i+": "+animsDatas[i].counter+"\n"); window.clearInterval(numAnimIntervals[i]); }
							}, 
							
							animsDatas[i].step
						)
					);
				}, 
				animsDatas[i].delay
			);
		}

		
	});
}