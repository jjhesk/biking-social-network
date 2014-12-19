<?php 
class FileUpload{
	public static function saveFile($ifile, $id, $uploaddir='photo/product/'){
		//LV2 function
		//$uploaddir = 'photo/product/';      //Uploading to same directory as PHP file
		if(!file_exists($uploaddir.$id)){
			mkdir($uploaddir.$id);
		}
		$file = basename($ifile['name']);
		$uploadFile = $file;
		$fileXtendion=substr($file, -4, 4);
		$randomNumber = date("Ymdhis")."_".rand(0, 99999)."_"; 
		//$newName = $uploaddir . $id."/". $randomNumber . $uploadFile;
		$newName = $uploaddir . $id."/". $randomNumber.$fileXtendion;
		
		//if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
		if (is_uploaded_file($ifile['tmp_name'])) {
			//echo "Temp file uploaded. \r\n";
		} else {
			//echo "Temp file not uploaded. \r\n";
			return false;
		}

		/*if ($_FILES['userfile']['size']> 300000) {
			exit("Your file is too large."); 
		}*/

		if(copy($ifile['tmp_name'], $newName)){
			return $newName;
		}else{
			return false;
		}
		/*if (move_uploaded_file($ifile['tmp_name'], $newName)) {
			return $newName;
		}else{
			return false;
		}*/
	}
	public static function image_resize($src, $dst, $width, $height, $crop=0, $rotate=0){
		//LV2 function
		  if(!list($w, $h) = getimagesize($src)){
			//return "Unsupported picture type!";
			return null;
		  }
		  $type = strtolower(substr(strrchr($src,"."),1));
		  if($type == 'jpeg') $type = 'jpg';
		  switch($type){
			case 'bmp': $img = imagecreatefromwbmp($src); break;
			case 'gif': $img = imagecreatefromgif($src); break;
			case 'jpg': $img = imagecreatefromjpeg($src); break;
			case 'png': $img = imagecreatefrompng($src); break;
			default : 
				//"Unsupported picture type!"
				return null;
		  }
			$x=0;
			$y=0;
		  // resize
		if($crop==1){
			//resize and crop image
			if($w < $width or $h < $height){
				//return "Picture is too small!";
				//return null;
				if($w<=$width){
					$ratio=$height/$h;
					$width=$ratio*$w;
				}
				if($h<=$height){
					$ratio=$width/$w;
					$height=$ratio*$h;
				}
				
			}else{
				$ratio = max($width/$w, $height/$h);
				
				$x = ($w - $width / $ratio) / 2;
				$y=($h - $height /$ratio) / 2;
				$h = $height / $ratio;
				$w = $width / $ratio;
				
			}
		}else if($crop==0){
			//resize
			if($w < $width and $h < $height){
				return null;
			}
			$ratio = min($width/$w, $height/$h);
			$width = $w * $ratio;
			$height = $h * $ratio;
			$x = 0;
			$y=0;

		}

		  $new = imagecreatetruecolor($width, $height);

		  // preserve transparency
		  if($type == "gif" or $type == "png"){
			imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
			imagealphablending($new, false);
			imagesavealpha($new, true);
		  }
		  if($rotate!=0){
			$img=imagerotate($img, $rotate, 0);
		  }
		  imagecopyresampled($new, $img, 0, 0, $x, $y, $width, $height, $w, $h);

		  switch($type){
			case 'bmp': imagewbmp($new, $dst); break;
			case 'gif': imagegif($new, $dst); break;
			case 'jpg': imagejpeg($new, $dst); break;
			case 'png': imagepng($new, $dst); break;
		  }
		  return $dst;
	}
	public static function rawjpeg_resize($src, $dst, $width, $height, $crop=0, $rotate=0){
		//LV2 function
		//$src is raw material, string
		// $dst is url...
		   $img = imagecreatefromString($src);
		   echo $w=ImageSX($img);
		   echo "<br/>";
		   echo $h=ImageSY($img);
		   $type="jpg";
			$x=0;
			$y=0;
		  // resize
		  if($crop){
			//resize and crop image
			if($w < $width or $h < $height){
				//return "Picture is too small!";
				//return null;
				if($w<=$width){
					$ratio=$height/$h;
					$width=$ratio*$w;
				}
				if($h<=$height){
					$ratio=$width/$w;
					$height=$ratio*$h;
				}
				
			}else{
				$ratio = max($width/$w, $height/$h);
				
				$x = ($w - $width / $ratio) / 2;
				$y=($h - $height /$ratio) / 2;
				$h = $height / $ratio;
				$w = $width / $ratio;
				
			}
		  }
		  else{
			//resize
			if($w < $width and $h < $height){
				return null;
			}
			$ratio = min($width/$w, $height/$h);
			$width = $w * $ratio;
			$height = $h * $ratio;
			$x = 0;
			$y=0;

		  }

		  $new = imagecreatetruecolor($width, $height);

		  // preserve transparency
		  if($type == "gif" or $type == "png"){
			imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
			imagealphablending($new, false);
			imagesavealpha($new, true);
		  }
		  if($rotate!=0){
			$img=imagerotate($img, $rotate, 0);
		  }
		  imagecopyresampled($new, $img, 0, 0, $x, $y, $width, $height, $w, $h);

		  switch($type){
			case 'bmp': imagewbmp($new, $dst); break;
			case 'gif': imagegif($new, $dst); break;
			case 'jpg': imagejpeg($new, $dst); break;
			case 'png': imagepng($new, $dst); break;
		  }
		  return $dst;
	}
}