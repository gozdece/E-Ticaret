<?php
class sayfalar extends Controller{

	function __construct() {
		parent::__construct();
		Session::init();

		
	}

	function iletisim(){

		$this->view->goster("sayfalar/iletisim");
	}

	function sepet(){

		$this->view->goster("sayfalar/sepet");
	}

	function siparisitamamla(){

		$this->view->goster("sayfalar/siparisitamamla");
	}
	
}
?>