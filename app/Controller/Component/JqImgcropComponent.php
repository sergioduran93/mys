<?php 
class JqImgcropComponent extends Object {

	public function initialize(){}

	public function startup(){}

	public function beforeRender(){}

	public function shutdown(){}

    public function uploadFile($uploadedInfo, $uploadTo, $prefix){
		$webpath     = $uploadTo;
		$upload_dir  = WWW_ROOT.str_replace("/", DS, $uploadTo);
		$upload_path = $upload_dir.DS;

		$userfile_name = $uploadedInfo['name'];
		$userfile_tmp  =  $uploadedInfo["tmp_name"];
		$userfile_size = $uploadedInfo["size"];
		$filename      = $prefix.basename($uploadedInfo["name"]);
		$file_ext      = substr($filename, strrpos($filename, ".") + 1);
		$uploadTarget  = $upload_path.$filename;

        move_uploaded_file($userfile_tmp, $uploadTarget );
    }
    
	public function uploadImage($uploadedInfo, $uploadTo, $prefix){
		$webpath     = $uploadTo;
		$upload_dir  = WWW_ROOT.str_replace("/", DS, $uploadTo);
		$upload_path = $upload_dir.DS;
		$max_file    = "34457280"; 						// Approx 30MB
		$max_width   = 800;

		$userfile_name = $uploadedInfo['name'];
		$userfile_tmp  =  $uploadedInfo["tmp_name"];
		$userfile_size = $uploadedInfo["size"];
		$filename      = $prefix.basename($uploadedInfo["name"]);
		$file_ext      = substr($filename, strrpos($filename, ".") + 1);
		$uploadTarget  = $upload_path.$filename;

		if(empty($uploadedInfo)) {
			return false;
		}  

		if (isset($uploadedInfo['name'])){
			move_uploaded_file($userfile_tmp, $uploadTarget );
			chmod ($uploadTarget , 0777);
			$width  = $this->getWidth($uploadTarget);
			$height = $this->getHeight($uploadTarget);
			//$width  = 180;
			//$height = 180;
			// Scale the image if it is greater than the width set above
			if ($width > $max_width){
				$scale    = $max_width/$width;
				$uploaded = $this->resizeImage($uploadTarget,$width,$height,$scale);
			}else{
				$scale    = 1;
				$uploaded = $this->resizeImage($uploadTarget,$width,$height,$scale);
			}
		}
		return array('imagePath' => $webpath.$filename, 'imageName' => $filename, 'imageWidth' => $this->getWidth($uploadTarget), 'imageHeight' => $this->getHeight($uploadTarget));
	}

	public function getHeight($image) {
		$sizes  = getimagesize($image);
		$height = $sizes[1];
		return $height;
	}
	public function getWidth($image) {
		$sizes = getimagesize($image);
		$width = $sizes[0];
		return $width;
	}

	public function resizeImage($image,$width,$height,$scale) {
		$newImageWidth  = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage       = imagecreatetruecolor($newImageWidth,$newImageHeight);
		$ext            = strtolower(substr(basename($image), strrpos(basename($image), ".") + 1));
		
		$source = "";
		if($ext == "png" || $ext == "PNG"){
			$source = imagecreatefrompng($image);
		}elseif($ext == "jpg" || $ext == "jpeg" || $ext == "JPEG" || $ext == "JPG"){
			$source = imagecreatefromjpeg($image);
		}elseif($ext == "gif" || $ext == "GIF"){
			$source = imagecreatefromgif($image);
		}
		imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
		imagejpeg($newImage,$image,90);
		chmod($image, 0777);
		return $image;
	}

	public function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
		$newImageWidth  = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage       = imagecreatetruecolor($newImageWidth,$newImageHeight);
		$ext            = strtolower(substr(basename($image), strrpos(basename($image), ".") + 1));
		
		$source = "";
		if($ext == "png"){
			$source = imagecreatefrompng($image);
		}elseif($ext == "jpg" || $ext == "jpeg"){
			$source = imagecreatefromjpeg($image);
		}elseif($ext == "gif"){
			$source = imagecreatefromgif($image);
		}
		
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		imagejpeg($newImage,$thumb_image_name,90);
		chmod($thumb_image_name, 0777);
		return $thumb_image_name;
	}

	public function cropImage($thumb_width, $x1, $y1, $x2, $y2, $w, $h, $thumbLocation, $imageLocation){
		$scale   = $thumb_width/$w;
		$cropped = $this->resizeThumbnailImage(WWW_ROOT.str_replace("/", DS,$thumbLocation),WWW_ROOT.str_replace("/", DS,$imageLocation),$w,$h,$x1,$y1,$scale);
		return $cropped;
	}
}
?>