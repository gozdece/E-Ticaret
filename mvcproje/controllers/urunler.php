<?php
class urunler extends Controller{

	function __construct() {
		parent::__construct();
		Session::init();

	$this->Modelyukle('urunler');
		
	}	

	function detay($id,$urunad){

		$sonuc = $this->model->uruncek("urunler","where id=".$id);
		$this->view->goster("sayfalar/urundetay",
			array(
				"data1" => $sonuc,
				"data2" => $this->model->uruncek("urunler","where katid=".$sonuc[0]["katid"]." and id !=".$id." and stok < 200 order by stok asc LIMIT 5"),
				"data3" => $this->model->uruncek("urunler","where katid=".$sonuc[0]["katid"]." and id !=".$id." and stok > 200 order by stok asc LIMIT 3"),
				"data4" => $this->model->uruncek("yorumlar","where urunid=$id")
			));

	}

	function kategori($id,$ad){

		$sonuc = $this->model->uruncek("urunler","where katid=".$id);
		$CocukKatBul = $this->model->uruncek("alt_kategori", "where id=".$id);

		$this->view->goster("sayfalar/kategori",
			array(
				"data1" => $sonuc,
				"data2" => $this->model->uruncek("alt_kategori","where cocuk_kat_id=".$CocukKatBul[0]["cocuk_kat_id"]." and id<>$id"),
				"data3" => $this->model->uruncek("urunler","where katid=".$id." and durum=1 LIMIT 5")
			));
	}
	
}
?>