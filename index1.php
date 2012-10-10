<?php

class SimpleImage {
 
   var $image;
   var $image_type;
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }
 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>index</title>
<style type="text/css">
body{
	margin:0px;
	padding:0px;
}
#app_main{
	background:rgb(50, 108, 153) url('img/app_main_background.png') no-repeat;
	height:593px;
	width:800px;
	position:relative;
}
#app_main div{
	margin-right:25px;
	padding:0px;
	float:left;
	position:relative;
	width:112px;
	height:38px;
	top: 546px;
	left: 195px;
}
#join_to_event_buton{
	background:url(img/join_event_buton_img.png) 0 0;
}
#join_vote_buton{
	background:url(img/join_event_buton_img.png) 0 0;
}
#rules_buton{
	background:url(img/join_event_buton_img.png) 0 0;
}
#join_vote_buton:hover{
	background:url(img/join_event_buton_img.png) 0 122px;
}
#rules_buton:hover{
	background:url(img/join_event_buton_img.png) 0 122px;
}
#join_to_event_buton:hover{	
	background:url(img/join_event_buton_img.png) 0 122px;
}
#app_event{
	margin:0px;
	padding:0px;
	background:rgb(50, 108, 153) url('img/join_to_event_background.png') no-repeat;
	width:800px;
	height:593px;
	position:relative;
}
#app_event div{
	top: 257px;
	left: 460px;
	position: relative;
	padding-bottom: 24px;
}
#app_rules{
	background:url('img/rules_background.png') no-repeat;
	width:800px;
	height:593px;
}

#app_rules div{
	top: 317px;
	left: 460px;
	position: relative;
	padding-bottom: 24px;
}




#name_text{
	width: 175px;
	height: 22px;
}
#surname_text{
	width: 175px;
	height: 22px;
}
#email_text{
	width: 175px;
	height: 22px;
}
#phone_text{
	width: 175px;
	height: 22px;
}
#file_text{
	width: 175px;
	height: 22px;
}
#regiter_buton{
	width: 175px;
	height: 22px;
}

.upload {
    position:relative;
    width:180px;
}
.realupload {
	position:absolute;
	top:0;
	right:-24px;
	/* start of transparency styles */
    opacity:0;
	-moz-opacity:0;
    filter:alpha(opacity:0);
	/* end of transparency styles */

    z-index:2; /* bring the real upload interactivity up front */
	width:180px;
}
form .fakeupload {
	top: 0px;
    left: 0px;
	list-style-type:none;
    background:url(img/choose_file_img.png) 0 0;
}
form .fakeupload:hover{
	background:url(img/choose_file_img.png) 0 118px;
}
form .fakeupload input {
	width:204px;
	height:30px;
}

div.fileinputs {
	position: relative;
}

div.fakefile {
	position: absolute;
	top: 0px;
	left: 0px;
	z-index: 1;
}

input.file {
	position: relative;
	text-align: right;
	-moz-opacity:0 ;
	filter:alpha(opacity: 0);
	opacity: 0;
	z-index: 2;
}
input.fakefile img{
	top:-5px;
}
#app_thanks{
	background:rgb(50, 108, 153) url('img/thanks_theme.png') no-repeat;
	width:800px;
	height:593px;
}
#app_thanks div{
	width:118px;
	height:77px;
	position:relative;
}
#warning_text{
	width:566px;
	height:39px;
	color:#FF0000;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 22px;
	top:200px !important;
	left:460px;
}
</style>
</head>

<body>

   
<?php



$go = isset($_GET['go']);
$type = isset($_GET['type']);
$sk = isset($_GET['sk']);

switch($go)
{
	case "join_to_event":
	?>
    <div id="app_event">
      <div id="warning_text">
      <?php
      if(isset($sk) && isset($type))
	  {
		  if($sk == "error" && $type == "file_type")
		  {
			  echo  "Dosya tipi hatası";
		  }
		  if($sk == "error" && $type == "move")
		  {
			  echo  "Dosya taşıma hatası";
		  }
		  if($sk == "error" && $type == "size")
		  {
			  echo  "Dosya boyut hatası";
		  }
		  if($sk == "error" && $type == "joined")
		  {
			  echo  "Bu Hesap İle Daha Önce Yarışmaya Katılım Yapılmıştır.";
		  }
	  }
	  ?>
      </div>
    <form name="event_form" method="post" enctype="multipart/form-data" onsubmit="return validate_fields();" action="?go=form_register">
    <div id="name_text"><input type="text" name="name_text" id="name_text" /></div>
    <div id="surname_text"><input type="text" name="surname_text" id="surname_text" /></div>
    <div id="email_text"><input type="text" name="email_text" id="email_text" /></div>
    <div id="phone_text"><input type="text" name="phone_text" id="phone_text" /></div>
    <div id="file_text">
     <div style="top:0px; left:0px; padding: 0px;width: 185px; height: 38px;" class="fakeupload">
      <li class="upload">
        <label for="realupload"> </label>
          <div >
              <input type="text" name="fakeupload" style="display:none;height:0;width:0;" /> <!-- browse button is here as background -->
          </div>
          <input type="file" name="image_file" id="realupload" class="realupload"  onchange="this.form.fakeupload.value = this.value;" />
      </li>
      </div>
    </div>
    <div style="" id="file_warning" class="file_warning"></div>
    <div id="regiter_buton"><input type="image" name="regiter_buton" src="" /></div>
    </form>
    </div>
    <?php
	break;
	case "form_register":
	
	$query = mysql_query("select * from lavazza_photoevent where fb_id='$fb_id'");
	if(mysql_affected_rows()>0)
	{
		echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php?go=join_to_event&sk=error&type=joined\">";
		exit();
	}
	else
	{
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$fb_id = $uid;
		$r_date = date("d-m-Y");
		$uzanti=array('image/jpeg','image/jpg','image/png','image/x-png','image/gif'); 
	   
		$dizin="upload_images/".uniqid('upload_images',true).$_FILES['image_file']['name']; 
		if(in_array(strtolower($_FILES['image_file']['type']),$uzanti)){
			if($_FILES['image_file']['size']<"999999")
			{
				if(move_uploaded_file($_FILES['image_file']['tmp_name'],$dizin))
				{
					$query = mysql_query("insert into lavazza_photoevent(fb_id,name,surname,email,phone,register_date,photo_url) values('$fb_id','$name','$surname','$email','$phone','$r_date','$dizin')");
					
					
					$image = new SimpleImage();
				    $image->load($dizin);
					$image_width = $image->getWidth();
					$image_height = $image->getHeight();
					if($image_width>600 && $image_height>600){
						$image->resize(600,600);
					}
					else if($image_height>600){
						$image->resizeToHeight(600);
					}
					else if($image_width>600){
						$image->resizeToWidth(600);	
					}
				    $image->save($dizin);
					
					
					echo "<meta http-equiv=\"refresh\" content=\"0; url=?go=success\">";
				}
				
			}
			else
			{
				echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php?go=join_to_event&sk=error&type=size\">";
			}
		}
		else
		{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php?go=join_to_event&sk=error&type=file_type\">";
		}
	}
	
	break;
	case "success":
	?>
    <div id="app_thanks">
    <div><a href="?go=join_to_event">Oylamaya Geç</a></div>
    </div>
    <?php
	break;
	case "rules":
	?>
    <div id="app_rules">
    <a href="?go=join_to_event"><div id="join_to_event_buton"></div></a>
    <a href="?go=rules"><div id="rules_buton"></div></a>
    <a href="?go=vote"><div id="join_vote_buton"></div></a>
    </div>
    <?php
	break;
	default:
	?>
    <div id="app_main">
    <a href="?go=join_to_event"><div id="join_to_event_buton"></div></a>
    <a href="?go=rules"><div id="rules_buton"></div></a>
    <a href="?go=vote"><div id="join_vote_buton"></div></a>
    </div>
    <?php
}
?>
</body>
</html>
