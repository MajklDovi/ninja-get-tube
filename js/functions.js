/*
 *
 *  Copyright (c) Michal Dovičovič
 *
 */

// Input form with link parser
function inputForm(){
		var url = document.forms["form"]["link"].value;
		// URL parser
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = url.match(regExp);
		if (match&&match[7].length==11){
			var b=match[7];
			var video_id = b;
		}else{
			alert("Not a YouTube address!");
		}

		$.getJSON('http://gdata.youtube.com/feeds/api/videos/'+video_id+'?v=2&alt=jsonc',function(data,status,xhr){
			alert(data.data.title);
		});
}





