<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Başlıksız Belge</title>
</head>

<body>

<?php
    $username = "oglumbakgitfilm";
    $limit = 10;
    $feed = 'http://twitter.com/statuses/user_timeline.rss?screen_name='.$username.'&count='.$limit;
    $tweets = file_get_contents($feed);
    
		$tweets = str_replace("&", "&", $tweets);	
		$tweets = str_replace("<", "<", $tweets);
		$tweets = str_replace(">", ">", $tweets);
		$tweet = explode("<item>", $tweets);
    $tcount = count($tweet) - 1;

for ($i = 1; $i <= $tcount; $i++) {
    $endtweet = explode("</item>", $tweet[$i]);
    $title = explode("<title>", $endtweet[0]);
    $content = explode("</title>", $title[1]);
		$content[0] = str_replace("&#8211;", "&mdash;", $content[0]);
	
		$content[0] = preg_replace("/(http:\/\/|(www\.))(([^\s<]{4,68})[^\s<]*)/", '<a href="http://$2$3" target="_blank">$1$2$4</a>', $content[0]);
		$content[0] = str_replace("$username: ", "", $content[0]);
		$content[0] = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $content[0]);
		$content[0] = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $content[0]);
    $mytweets[] = $content[0];
}
$tweetout = "";
if(isset($tweetout)){
while (list(, $v) = each($mytweets)) {
	$v = iconv('iso-8859-9','utf-8',$v);
	$tweetout .= "<p>".$v."</p>\n";
}
}
?>

<?php

echo $tweetout;?></div>	


</body>
</html>