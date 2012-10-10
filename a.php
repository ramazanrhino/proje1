<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Başlıksız Belge</title>
</head>

<body>
<div id="last tweet">

</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){



var username='oglumbakgitfilm'; // set user name
var format='json'; // set format, you really don't have an option on this one
$limit=20;
var url='http://api.twitter.com/1/statuses/user_timeline/'+username+'.'+format+'?callback=?'; // make the url

	$.getJSON(url,function(tweet){
		 for($i=0; $i<$limit; $i++){
			$("#last-tweet").append(tweet[$i].text+"<br>"); // get the first tweet in the response and place it inside the div
		 }
	});
	
});
</script>



<?php
$username='webhole';
$format='xml';
$tweet=simplexml_load_file("http://api.twitter.com/1/statuses/user_timeline/$username.$format");

echo $tweet->status[0]->text;
?>
</body>
</html>
