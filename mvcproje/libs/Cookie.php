<?php

class  Cookie {

	public static function SepeteEkle ($id,$adet) {
		if(isset($_COOKIE["urun"])){
			if(array_key_exists($id, $_COOKIE["urun"])){
				$adetal = $_COOKIE["urun"][$id];
				$sonadet = $adetal + $adet;
				setcookie('urun['.$id.']',$sonadet,time()+60*60*24,"/");
			}else{
				setcookie('urun['.$id.']',$adet,time()+60*60*24,"/");
			}	
		}else{
			setcookie('urun['.$id.']',$adet,time()+60*60*24,"/");
		}
		
			
	}

	public static function SepeteBak () {
		
		if (isset($_COOKIE["urun"])) {
			foreach ($_COOKIE["urun"] as $id => $adet) {
				echo "ürün id:".$id."Adet:".$adet."<br>";
			}
		}else{
			return false;
		}
			
	}

	public static function UrunUcur ($id) {
		
		if (isset($_COOKIE["urun"])) {
			setcookie('urun['.$id.']',false,time()-2,"/");
		}else{

		}
			
	}

	public static function Guncelle ($id,$adet) {
		
		if (isset($_COOKIE["urun"])) {

			//$adetal = $_COOKİE["urun"][$id];
			//$sonadet = $adetal + $adet;
			setcookie('urun['.$id.']',$adet,time()+60*60*24,"/");
		}else{

		}
			
	}

	public static function SepetiBosalt () {
		
		if (isset($_COOKIE["urun"])) {

			foreach($_COOKIE["urun"] as $id => $adet){
				setcookie('urun['.$id.']',false,time()-2,"/");
			}
		}else{
			return true;
		}
			
	}


	
}




?>