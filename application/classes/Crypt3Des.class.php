<?php
class Crypt3Des {
	public $key= "12345678901234567890123456789012";
	public $iv= "23456789";
	
	public function setKey($key, $iv){
		$this->key=$key;
		$this->$iv=$iv;
	}
	//�[�K
	public function encrypt($input){
		$input = $this->padding( $input );
		$key = base64_decode($this->key);
		$td = mcrypt_module_open( MCRYPT_3DES, '', MCRYPT_MODE_CBC, '');
		//�ϥ�MCRYPT_3DES��k,cbc�Ҧ�
		mcrypt_generic_init($td, $key, $this->iv);
		//��l?�z
		$data = mcrypt_generic($td, $input);
		//�[�K
		mcrypt_generic_deinit($td);
		//?��
		mcrypt_module_close($td);
		$data = $this->removeBR(base64_encode($data));
		return $data;
	}

	//�ѱK
	public function decrypt($encrypted){
		$encrypted = base64_decode($encrypted);
		$key = base64_decode($this->key);
		$td = mcrypt_module_open( MCRYPT_3DES,'',MCRYPT_MODE_CBC,'');
		//�ϥ�MCRYPT_3DES��k,cbc�Ҧ�
		mcrypt_generic_init($td, $key, $this->iv);
		//��l?�z
		$decrypted = mdecrypt_generic($td, $encrypted);
		//�ѱK
		mcrypt_generic_deinit($td);
		//?��
		mcrypt_module_close($td);
		$decrypted = $this->removePadding($decrypted);
		return $decrypted;
	}

	//��R�K?�A��R��8����?
	public function padding( $str ){
		$len = 8 - strlen( $str ) % 8;
		for ( $i = 0; $i < $len; $i++ )
		{
			$str .= chr( 0 );
		}
		return $str ;
	}

	//?����R��
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
	//?���^?�M?��
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