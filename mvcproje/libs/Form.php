<?php

class Form extends Bilgi  {
	
		public $deger,$veri;
		public $error=array(),$sonuc=array();

		
		function get ($key) {
			
			$this->deger=$key;
					
			
			$this->veri=htmlspecialchars(strip_tags($_POST[$key]));
			
			return $this;
				
		}
	
		function bosmu() {
		
			
			if (empty($this->veri)) :
			$this->error[]=$this->deger. " boş olamaz";
			
					
			return $this;
			
			else:
			
			return $this->veri;
			
			
			endif;
			
		}
		
		function GercektenMailMi($email){

			$sunucu= substr($email,strpos($email,'@')+1);
			getmxrr($sunucu, $this->sonuc);

			if(!(count($this->sonuc)>0)){
				
				$this->error[]="Mail adresi geçersiz";
			}
		}
	
		function SifreTekrar($deger,$deger2){
			if ($deger != $deger2) {
				$this->error[]="Girilen şifreler uyumsuz";
			}else{
				return $this->sifrele($deger);
			}
		}

		function sifrele($veri){
			return base64_encode(gzdeflate(gzcompress(serialize($veri))));
		}
		
		function coz(){
			return unserialize(gzuncompress(gzinflate(base64_decode($veri))));
		}

		public static function Olustur($kriter,array $veri=NULL) {
		
		/*
		1 form
		2 input
		3 textarea	
		
		*/
		switch ($kriter):
			
		case "1": echo '<form ';	break;
		case "2": echo '<input ';	break;
		case "3": echo '<textarea '; break;	
		case "kapat": echo '</form> '; break;		
		endswitch;		
		
		
		if (isset($veri)) :
		
		
		
		
		foreach ($veri as $anahtar => $deger) :
		
		echo $anahtar."='".$deger."' ";	
				
		endforeach;
		
		echo ($kriter==3) ? '></textarea>' : '>'; // ternay tek satır sorgu
		
		endif;	
				
		
		
		/* 2.YÖNTEM
		
		// "method@POST",
		echo '<form ';
		
		foreach ($veri as  $deger) :
		
		$bol=explode("@",$deger);
		// $bol
		
		echo $bol[0]."='".$bol[1]."' ";
		
				
		endforeach;
		
		echo '>';
	
	*/
	}

}




?>