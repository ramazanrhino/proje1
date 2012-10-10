<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Başlıksız Belge</title>
</head>

<body>
<?php



error_reporting(E_ALL);
$feedURL = 'http://gdata.youtube.com/feeds/api/users/InnaRomania/uploads?max-results=50';
$sxml = simplexml_load_file($feedURL);
$i=0;
foreach ($sxml->entry as $entry) {
      $media = $entry->children('media', true);
      $watch = (string)$media->group->player->attributes()->url;
      $thumbnail = (string)$media->group->thumbnail[0]->attributes()->url;
	  
	  parse_str( parse_url( $watch, PHP_URL_QUERY ), $my_array_of_vars ); 
	  
      ?>
      <div class="videoitem">
        <div class="videothumb"><a href="<?php echo $watch; ?>" class="watchvideo"><img src="<?php echo $thumbnail;?>" alt="<?php echo $media->group->title; ?>" /><?php   echo $my_array_of_vars['v'];  ?></a></div>
        <div class="videotitle">
            <h3><a href="<?php echo $watch; ?>" class="watchvideo"><?php echo $media->group->title; ?></a></h3>
            <p><?php echo $media->group->description; ?></p>
        </div>
      </div>      
<?php $i++; if($i==3) { echo '<div class="clear small_v_margin"></div>'; $i=0; } } ?>
</body>
</html>