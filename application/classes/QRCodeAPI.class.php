<?php 
class QRCodeAPI{
	public static function createImage($data, $filename){
		//LV2
		// $filename='photo/company/2/qrcode.png'
		include_once(WEBSITE_FS_PATH.'/includes/libraries/phpqrcode/qrlib.php');
		$errorCorrectionLevel = 'L';
		$matrixPointSize = 3;
		QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);  
		return $filename;
	}
	
}  
?>