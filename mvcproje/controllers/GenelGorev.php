<?php
class GenelGorev extends Controller{

	function __construct() {
		parent::__construct();
	
	$this->Modelyukle('GenelGorev');
		
	}	


	function YorumFormKontrol(){

		$ad = $this->form->get("ad")->bosmu();
		$yorum = $this->form->get("yorum")->bosmu();
		$urunid = $this->form->get("urunid")->bosmu();
		$uyeid= $this->form->get("uyeid")->bosmu();
		$tarih = date("d.m.Y");
	
		if(!empty($this->form->error)){
			
			$this->bilgi->uyari("danger","Lütfen boş alan bırakmayın",'id="no"');
		}else{

			$sonuc = $this->model->YorumEkleme("yorumlar",array("uyeid","urunid","ad","icerik","tarih"), array($uyeid,$urunid,$ad,$yorum,$tarih));

			if ($sonuc==1){
				
				echo $this->bilgi->uyari("success","Yorumunuz kayıt edildi.",'id="ok"');
			}else{
				
				echo $this->bilgi->uyari("danger","HATA OLUŞTU. LÜTFEN DAHA SONRA TEKRAR DENEYİNİZ");
			}

		}
	}

	function BultenKayit(){
		$mailadres = $this->form->get("mailadres")->bosmu();
		$this->form->GercektenMailMi($mailadres);
		$tarih=date("d.m.Y");
	


		if(!empty($this->form->error)){
			
			echo $this->bilgi->uyari("danger","Girilen mail adresi geçersiz");
		}else{

			$sonuc = $this->model->BultenEkleme("bulten",array("mailadres","tarih"), array($mailadres,$tarih));

			if($sonuc == 1 ){

				echo $this->bilgi->uyari("success","Bultene başarılı bir şekilde kayıt oldunuz.",'id="Bultenok"');
			}else{
				echo $this->bilgi->uyari("danger","Hata oluştu, tekrar deneyin");
			}
		}
	}

	function iletisim(){

		$ad = $this->form->get("ad")->bosmu();
		$mailadres = $this->form->get("mail")->bosmu();
		$konu = $this->form->get("konu")->bosmu();
		$mesaj = $this->form->get("mesaj")->bosmu();

		$tarih=date("d.m.Y");

		@$this->form->GercektenMailMi($mailadres);

		if(!empty($this->form->error)){
			
			echo $this->bilgi->uyari("danger","Lütfen tüm bilgileri doğru girin.");
		}else{

			$sonuc = $this->model->iletisimForm("iletisim",array("ad","mail","konu","mesaj","tarih"), array($ad,$mailadres,$konu,$mesaj,$tarih));

			if($sonuc == 1 ){

				echo $this->bilgi->uyari("success","Mesajınız alındı.",'id="formok"');
			}else{
				echo $this->bilgi->uyari("danger","Hata oluştu, tekrar deneyin");
			}
		}

	}

	function SepeteEkle(){

		Cookie::SepeteEkle($this->form->get("id")->bosmu(),$this->form->get("adet")->bosmu());
	}

	function UrunSil(){
		if($_POST){
		Cookie::UrunUcur($_POST["urunid"]);
		}
	}

	function UrunGuncelle(){
		if($_POST){
			Cookie::Guncelle($_POST["urunid"],$_POST["adet"]);
		}
		
	}

	function SepetiBosalt(){
		$this->bilgi->direktYonlen("/sayfalar/sepet");
		Cookie::SepetiBosalt();
	}

	function SepetKontrol(){

		echo '<a href="'.URL.'/sayfalar/sepet">
		<h3><img src="'.URL.'/views/design/images/bag.png"></h3>
		<p>';

		if(isset($_COOKIE["urun"])){
			echo count($_COOKIE["urun"]);
		}else{
			echo "Sepetiniz boş";
		}
	}

	
	
}

?>