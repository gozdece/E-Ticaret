<?php

class uye extends Controller  {
	
	
	function __construct() {
		parent::__construct();

		$this->Modelyukle('uye');
		Session::init();
		
	}	

	function giris(){

		$this->view->goster("sayfalar/giris");
	}

	function hesapOlustur(){

		$this->view->goster("sayfalar/uyeOl");
	}

	function cikis(){
		
		Session::destroy();
		$this->bilgi->direktYonlen("/magaza");
	}

	function kayitKontrol(){
		$ad = $this->form->get("ad")->bosmu();
		$soyad = $this->form->get("soyad")->bosmu();
		$email = $this->form->get("email")->bosmu();
		$sifre = $this->form->get("sifre")->bosmu();
		$sifreTekrar = $this->form->get("sifreTekrar")->bosmu();
		$telNo = $this->form->get("telNo")->bosmu();
		$this->form->GercektenMailMi($email);
		$sifre= $this->form->SifreTekrar($sifre,$sifreTekrar);


		if(!empty($this->form->error)){
			//bir hata var demektir
			$this->view->goster("sayfalar/uyeOl",
				array(
					"hata" => $this->form->error));
		}else{

			$sonuc = $this->model->UyeKayit("uye_panel",array("ad","soyad","mail","sifre","telefon"), array($ad,$soyad,$email,$sifre,$telNo));

			if($sonuc == 1 ){

				$this->view->goster("sayfalar/uyeOl",array("bilgi" => $this->bilgi->uyari("success","Kayıt Başarılı")));

			}else{
				$this->view->goster("sayfalar/uyeOl",
					array("bilgi" => $this->bilgi->uyari("danger","Kayıt esnasında hata oluştu")));
			}
		}

	}

	function girisKontrol(){

		$ad = $this->form->get("ad")->bosmu();
		$sifre = $this->form->get("sifre")->bosmu();

		if(!empty($this->form->error)){
			//bir hata var demektir
			$this->view->goster("sayfalar/giris",
				array(
					"bilgi" => $this->bilgi->uyari("danger","Kullanıcı adı veya şifresi boş olamaz.")));
		}else{

			$sifre = $this->form->sifrele($sifre);
			$sonuc = $this->model->GirisKontrol("uye_panel","ad='$ad' and sifre='$sifre'");

			if(is_array($sonuc)){

				$this->bilgi->direktYonlen("/uye/panel");

				Session::init();
				Session::set("kulad",$sonuc[0]["ad"]);
				Session::set("uye",$sonuc[0]["id"]);

			}else{
				$this->view->goster("sayfalar/giris",
					array("bilgi" => $this->bilgi->uyari("danger","Kullanıcı adı veya şifresi hatalıdır.")));
			}
		}


	}
	function Panel(){

		$this->view->goster("sayfalar/panel",array(
		"siparisler" => $this->model->yorumlarial("siparisler","where uyeid=".Session::get("uye"))));
	}

	function siparislerim() {	
		$this->view->goster("sayfalar/panel",array(
		"siparisler" => $this->model->yorumlarial("siparisler","where uyeid=".Session::get("uye"))));			
	}
	function hesapayarlarim() {	
	
		$this->view->goster("sayfalar/panel",array(
		"ayarlar" => $this->model->yorumlarial("uye_panel","where id=".Session::get("uye"))));		
	}

	function ayarGuncelle() {		
		if ($_POST) :	
		
		$ad=$this->form->get("ad")->bosmu();
		$soyad=$this->form->get("soyad")->bosmu();
		$mail=$this->form->get("mail")->bosmu();
		$telefon=$this->form->get("telefon")->bosmu();
		$uyeid=$this->form->get("uyeid")->bosmu();

			if (!empty($this->form->error)) :
			$this->view->goster("sayfalar/panel",
			array(
			"ayarlar" => $this->model->yorumlarial("uye_panel","where id=".Session::get("uye")),
			"bilgi" => $this->bilgi->uyari("danger","Girilen bilgiler hatalıdır.")
			));
	 	
			else:	
			$sonuc=$this->model->AyarlarGuncelle("uye_panel",
			array("ad","soyad","mail","telefon"),
			array($ad,$soyad,$mail,$telefon),"id=".$uyeid);
	
				if ($sonuc): 
				$this->view->goster("sayfalar/panel",
				array(
				"ayarlar" => "ok",
				"bilgi" => $this->bilgi->basarili("GÜNCELLEME BAŞARILI","/uye/panel")
				));
				
				else:
		
				$this->view->goster("sayfalar/panel",
				array(
				"ayarlar" => $this->model->yorumlarial("uye_panel","where id=".Session::get("uye")),
				"bilgi" => $this->bilgi->uyari("danger","Güncelleme sırasında hata oluştu.")
			 	));	
		
				endif;
	
			endif;

		else:	
	
			$this->bilgi->direktYonlen("/");
		endif;
	
	}

	function sifredegistir() {	
	
		$this->view->goster("sayfalar/panel",array(
		"sifredegistir" => Session::get("uye")));		
	}

	function sifreguncelle() {		
		if ($_POST) :		
			$msifre=$this->form->get("msifre")->bosmu();
			$yen1=$this->form->get("yen1")->bosmu();
			$yen2=$this->form->get("yen2")->bosmu();
			$uyeid=$this->form->get("uyeid")->bosmu();
			$sifre=$this->form->SifreTekrar($yen1,$yen2); // ŞİFRELİ YENİ HALİ ALIYORUM
			$msifre=$this->form->sifrele($msifre);
			if (!empty($this->form->error)) :
			$this->view->goster("sayfalar/panel",
			array(
			"sifredegistir" => Session::get("uye"),
			"bilgi" => $this->bilgi->uyari("danger","Girilen bilgiler hatalıdır.")
			));
	
			else:	
			$sonuc2=$this->model->GirisKontrol("uye_panel","ad='".Session::get("kulad")."' and sifre='$msifre'");
	
				if ($sonuc2): 
		
					$sonuc=$this->model->sifreGuncelle("uye_panel",
					array("sifre"),
					array($sifre),"id=".$uyeid);
			
						if ($sonuc): 
							
							$this->view->goster("sayfalar/panel",
							array(
							"sifredegistir" => "ok",
							"bilgi" => $this->bilgi->basarili("ŞİFRE DEĞİŞTİRME BAŞARILI","/uye/panel")
			 				));
					
						else:
				
							$this->view->goster("sayfalar/panel",
							array(
							"sifredegistir" => Session::get("uye"),
							"bilgi" => $this->bilgi->uyari("danger","Şifre değiştirme sırasında hata oluştu.")
							));	
				
						endif;
				else:

					$this->view->goster("sayfalar/panel",
					array(
					"sifredegistir" => Session::get("uye"),
					"bilgi" => $this->bilgi->uyari("danger","Mevcut şifre hatalıdır.")
					));
				endif;
	
			endif;

		else:	
	
			$this->bilgi->direktYonlen("/");
		endif;
	
	}

	function adreslerim() {	
		
		$this->view->goster("sayfalar/panel",array(
		"adres" => $this->model->yorumlarial("adresler","where uyeid=".Session::get("uye"))
		));
	}
	
	function yorumlarim() {	

		$this->view->goster("sayfalar/panel",array(
		"yorumlar" => $this->model->yorumlarial("yorumlar","where uyeid=".Session::get("uye"))
		));
	}

	function YorumSil(){
		if ($_POST) {
			echo $this->model->YorumSil("yorumlar", "id=".$_POST["yorumid"]);
		}
	}

	function AdresSil(){
		if ($_POST) {
			echo $this->model->YorumSil("adresler", "id=".$_POST["adresid"]);
		}
	}

	function yorumGuncelle(){
		if($_POST){
			echo $this->model->YorumGuncelle("yorumlar",
				array("icerik"),
				array($_POST["yorum"]),"id=".$_POST["yorumid"]);	
		}
	}


	function adresGuncelle(){
		if($_POST){
			
			echo $this->model->YorumGuncelle("adresler",
				array("adres"),
				array($_POST["adres"]),"id=".$_POST["adresid"]);	
		}
	}

	function siparisTamamlandi(){

		$ad = $this->form->get("ad")->bosmu();
		$soyad = $this->form->get("soyad")->bosmu();
		$mail = $this->form->get("mail")->bosmu();
		$telefon = $this->form->get("telefon")->bosmu();
		$adresTercih = $this->form->get("adresTercih")->bosmu();
		$odeme = $this->form->get("odeme")->bosmu();
		$toplam = $this->form->get("toplam")->bosmu();

		$odemeturu = ($odeme==1) ? "Nakit" : "Hata";
		$tarih = date("d.m.Y");

		if(!empty($this->form->error)){
			$this->view->goster("sayfalar/siparistamamla",array("bilgi"=>$this->bilgi->uyari("danger","Bilgiler eksiksiz doldurulmalıdır.")));
		}else{
			$siparisno = mt_rand(0,99999999);
			$uyeid = Session::get("uye");

				$this->model->TopluislemBaslat();

				if(isset($_COOKIE["urun"])){
					foreach ($_COOKIE["urun"] as $id => $adet) {
					$GelenUrun=$this->model->SiparisTamamlamaUrunCek("urunler","where id=".$id);

					$SiparisTablosunaEkleme = $this->model->SiparisTamamlama(
						array($siparisno,$uyeid,$adresTercih,$GelenUrun[0]["urunad"],$adet,$GelenUrun[0]["fiyat"],$GelenUrun[0]["fiyat"]*$adet,$tarih,$odemeturu)
					);
				}

					$this->model->TopluIslemTamamla();

					Cookie::SepetiBosalt();

					$TeslimatBilgileri = $this->model->UyeKayit("teslimatbilgileri",
						array("siparisno","ad","soyad","mail","telefon"),
						array($siparisno,$ad,$soyad,$mail,$telefon)
					);

					if($TeslimatBilgileri==1){

						$this->view->goster("sayfalar/siparistamamlandi",array("siparisno"=>$siparisno,"toplamtutar"=>$toplam));
					}else{
						$this->view->goster("sayfalar/siparisitamamla",array("bilgi"=>$this->bilgi->uyari("danger","Sipariş oluşturulurken hata oluştu")));
					}
				}else{
					$this->bilgi->direktYonlen("/");
				}

				
		}

	}
}	


?>