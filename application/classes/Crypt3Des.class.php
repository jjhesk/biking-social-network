<?php
class Crypt3Des {
	public $key= "12345678901234567890123456789012";
	public $iv= "23456789";
	
	public function setKey($key, $iv){
		$this->key=$key;
		$this->$iv=$iv;
	}
	//加密
	public function encrypt($input){
		$input = $this->padding( $input );
		$key = base64_decode($this->key);
		$td = mcrypt_module_open( MCRYPT_3DES, '', MCRYPT_MODE_CBC, '');
		//使用MCRYPT_3DES算法,cbc模式
		mcrypt_generic_init($td, $key, $this->iv);
		//初始?理
		$data = mcrypt_generic($td, $input);
		//加密
		mcrypt_generic_deinit($td);
		//?束
		mcrypt_module_close($td);
		$data = $this->removeBR(base64_encode($data));
		return $data;
	}

	//解密
	public function decrypt($encrypted){
		$encrypted = base64_decode($encrypted);
		$key = base64_decode($this->key);
		$td = mcrypt_module_open( MCRYPT_3DES,'',MCRYPT_MODE_CBC,'');
		//使用MCRYPT_3DES算法,cbc模式
		mcrypt_generic_init($td, $key, $this->iv);
		//初始?理
		$decrypted = mdecrypt_generic($td, $encrypted);
		//解密
		mcrypt_generic_deinit($td);
		//?束
		mcrypt_module_close($td);
		$decrypted = $this->removePadding($decrypted);
		return $decrypted;
	}

	//填充密?，填充至8的倍?
	public function padding( $str ){
		$len = 8 - strlen( $str ) % 8;
		for ( $i = 0; $i < $len; $i++ )
		{
			$str .= chr( 0 );
		}
		return $str ;
	}

	//?除填充符
	public function removePadding( $str )
	{
		$len = strlen( $str );
		$newstr = "";
		$str = str_split($str);
		for ($i = 0; $i < $len; $i++ )
		{
		if ($str[$i] != chr( 0 ))
		{
		$newstr .= $str[$i];
		}
		}
		return $newstr;
	}
	//?除回?和?行
	public function removeBR( $str ) 
	{
		$len = strlen( $str );
		$newstr = "";
		$str = str_split($str);
		for ($i = 0; $i < $len; $i++ )
		{
			if ($str[$i] != '\n' and $str[$i] != '\r')
			{
			$newstr .= $str[$i];
			}
		}

		return $newstr;
	}
}
?>