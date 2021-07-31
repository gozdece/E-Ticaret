<?php

class uye_model extends Model {
	
	
	function __construct() {		
		parent:: __construct();
	}
	
	
	function GirisKontrol($tabloisim,$kosul){

		return $this->db->giriskontrol($tabloisim,$kosul);
	}

	function UyeKayit($tabloisim,$sutunadlari,$veriler){

		return $this->db->Ekle($tabloisim,$sutunadlari,$veriler);
	}

	function yorumlarial($tabloisim,$kosul) {
		
		return $this->db->listele($tabloisim,$kosul);	
	}
	function AyarlarGuncelle($tabloisim,$sutunlar,$veriler,$kosul) {
		
		
		return $this->db->guncelle($tabloisim,$sutunlar,$veriler,$kosul);
	}

	function sifreGuncelle($tabloisim,$sutunlar,$veriler,$kosul) {
		
		
		return $this->db->guncelle($tabloisim,$sutunlar,$veriler,$kosul);
	}
	
	function YorumSil($tabloisim,$kosul){
		return $this->db->sil($tabloisim,$kosul);
	}

	function YorumGuncelle($tabloisim,$sutunlar,$veriler,$kosul){
		return $this->db->guncelle($tabloisim,$sutunlar,$veriler,$kosul);
	}

	function ayarGuncelle($tabloisim,$kosul){
		return $this->db->guncelle($tabloisim,$sutunlar,$veriler,$kosul);
	}


	function SiparisTamamlamaUrunCek($tabloisim,$kosul){
		return $this->db->listele($tabloisim,$kosul);
	}

	function SiparisTamamlama($veriler){
		return $this->db->siparisTamamla($veriler);
	}

	function TopluislemBaslat(){
		return $this->db->beginTransaction();
	}

	function TopluIslemTamamla(){
		return $this->db->commit();
	}
	

	

	
}




?>