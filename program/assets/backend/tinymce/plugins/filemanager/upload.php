<?php

session_start();
if($_SESSION["verify"] != "FileManager4TinyMCE") die('forbiden');

include('config.php');
include('utils.php');


$ds          = DIRECTORY_SEPARATOR; 
 
$storeFolder = $_POST['path'];
$storeFolderThumb = $_POST['path_thumb'];

if(strpos($storeFolder,$upload_dir)===FALSE || strpos($storeFolderThumb,'thumbs')===FALSE) die('wrong path');
 
if (!empty($_FILES) && $upload_files) {
     
    $tempFile = $_FILES['file']['tmp_name'];   
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 
    $targetPathThumb = dirname( __FILE__ ) . $ds. $storeFolderThumb . $ds; 
     
    $targetFile =  $targetPath. $_FILES['file']['name']; 
    $targetFileThumb =  $targetPathThumb. $_FILES['file']['name']; 
 
    if(in_array(substr(strrchr($_FILES['file']['name'],'.'),1),$ext_img)) $is_img=true;
	else $is_img=false;

	if($is_img){
		create_img_gd($tempFile, $targetFileThumb, 122, 91);

		$imginfo =getimagesize($tempFile);
		$srcWidth = $imginfo[0];
   		$srcHeight = $imginfo[1];
		
		if($image_resizing){
			
			if($image_width==0){
				if($image_height==0){
					$image_width=$srcWidth;
					$image_height =$srcHeight;
				}else{
					$image_width=$image_height*$srcWidth/$srcHeight;
			}
			}elseif($image_height==0){
				$image_height =$image_width*$srcHeight/$srcWidth;
			}
			$srcWidth=$image_width;
			$srcHeight=$image_height;
			create_img_gd($tempFile, $targetFile, $image_width, $image_height);
		}else
			move_uploaded_file($tempFile,$targetFile);
		
		//max resizing limit control
		$resize=false;
		if($image_max_width!=0 && $srcWidth >$image_max_width){
			$resize=true;
			$srcHeight=$image_max_width*$srcHeight/$srcWidth;
			$srcWidth=$image_max_width;
		}
		
		if($image_max_height!=0 && $srcHeight >$image_max_height){
			$resize=true;
			$srcWidth =$image_max_height*$srcWidth/$srcHeight;
			$srcHeight =$image_max_height;
		}
		if($resize)
			create_img_gd($targetFile, $targetFile, $srcWidth, $srcHeight);	
		
	}else{
		move_uploaded_file($tempFile,$targetFile);
	}
}
if(isset($_POST['submit'])){
	header("location: dialog.php?type=".$_POST['type']."&lang=".$_POST['lang']."&subfolder=".$_POST['subfolder']."&field_id=".$_POST['field_id']."&editor=".$_POST['editor']."&fldr=".$_POST['fldr']);
}

?>      