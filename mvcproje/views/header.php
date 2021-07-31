<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php $ayarlar = new Ayarlar();
ob_start();

 ?>
<!DOCTYPE html>
<html>
<head>

<link href="<?php echo URL; ?>/views/design/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo URL; ?>/views/design/js/jquery.min.js"></script>
<script src="<?php echo URL; ?>/views/design/js/benim.js"></script>



<!-- Custom Theme files -->
<link href="<?php echo URL; ?>/views/design/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="<?php echo URL; ?>/views/design/css/component.css" rel='stylesheet' type='text/css' />


<title><?php echo $ayarlar->title; ?></title>


  <meta name="description" content="<?php echo $ayarlar->sayfaAciklama;?> " />
  <meta name="keywords" content="<?php echo $ayarlar->anahtarKelime;?> " />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<!-- for bootstrap working -->
	<script type="text/javascript" src="<?php echo URL; ?>/views/design/js/bootstrap-3.1.1.min.js"></script>

<!-- //for bootstrap working -->
<!-- cart -->
	<script src="<?php echo URL; ?>/views/design/js/simpleCart.min.js"> </script>
<!-- cart -->
<link rel="stylesheet" href="<?php echo URL; ?>/views/design/css/flexslider.css" type="text/css" media="screen" />
<script>
	$(document).ready(function(e){

		
		$("#yorumGonder").click(function(){
			$.ajax({
				type:"POST",
				url:'http://gozdecengiz.cf/GenelGorev/YorumFormKontrol',
				data:$('#yorumForm').serialize(),
				success: function(donen_veri){
					$('#yorumForm').trigger("reset");
					$('#FormSonuc').html(donen_veri);
				},
			});
		});

		var ad,soyad,mail,telefon;
		$('input[name=bilgiTercih]').on('change',function(){
			var gelenTercih=$(this).val();

			if(gelenTercih==1){
				ad=$('input[id=sipAd]').val();
				soyad=$('input[id=sipSoyad]').val();
				mail=$('input[id=sipMail]').val();
				telefon=$('input[id=sipTelefon]').val();

				$('input[id=sipAd]').val("");
				$('input[id=sipSoyad]').val("");
				$('input[id=sipMail]').val("");
				$('input[id=sipTelefon]').val("");

			}else{
				$('input[id=sipAd]').val(ad);
				$('input[id=sipSoyad]').val(soyad);
				$('input[id=sipMail]').val(mail);
				$('input[id=sipTelefon]').val(telefon);
			}
		});

	

		

		
		
	});
	function UrunSil(deger,kriter){

	switch (kriter){

		case "sepetsil":
		$.post("<?php echo URL; ?>/GenelGorev/UrunSil",{"urunid":deger},function(){
			window.location.reload();
		});
		break;
		case "yorumsil":
		$.post("<?php echo URL; ?>/uye/YorumSil",{"yorumid":deger},function(donen){

			if(donen==1){
				$("#Sonuc").html("Yorum basarıyla silindi");
			}else{
				$("#Sonuc").html("Silme işleminde hata oluştu");
			}
			$("#Sonuc").fadeIn(1500,function(){
				$("#Sonuc").fadeOut(200,function(){
					$("#Sonuc").html("");
					window.location.reload();
				});
			});
			
		});
		break;
		case "adressil":
		$.post("<?php echo URL; ?>/uye/AdresSil",{"adresid":deger},function(donen){
			if(donen==1){
				$("#Sonuc").html("Adres basarıyla silindi");
			}else{
				$("#Sonuc").html("Silme işleminde hata oluştu");
			}
			$("#Sonuc").fadeIn(1500,function(){
				$("#Sonuc").fadeOut(800,function(){
					$("#Sonuc").html("");
					window.location.reload();
				});
			});
		});
		break;
		default:
		break;
	}
}


</script>
</head>
<body>
	<!-- header-section-starts -->
	<div class="header">
		<div class="header-top-strip">
			<div class="container">
				<div class="header-top-left">
										<ul>
                    
                    <?php
					
					
			if (Session::get("kulad") && Session::get("uye") ) :
				$sonuc = Session::OturumKontrol(Session::get("kulad"),Session::get("uye"));
				
			 ?>
			
           <li> <a href="<?php echo URL; ?>/uye/panel">Hesabım<?php echo $sonuc[0]["ad"];?></a></li>
            
            <?php else: ?>
            
            
            <li><a href="<?php echo URL; ?>/uye/giris"><span class="glyphicon glyphicon-user"> </span>Giriş </a></li>
						<li><a href="<?php echo URL; ?>/uye/hesapOlustur"><span class="glyphicon glyphicon-lock"> </span>Hesap Oluştur</a></li>	
			
            
			
			<?php
			endif;
					
					
					?>
                    
								
					</ul>
				</div>
				<div class="header-right">
						<div class="cart box_1" id="SepetDurum">
							
							<div class="clearfix"> </div>
						</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- header-section-ends -->
		<div class="banner-top">
			<div class="container">
				<nav class="navbar navbar-default" role="navigation">
	    			<div class="navbar-header">
	        			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        			<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
		        			<span class="icon-bar"></span>
		        			<span class="icon-bar"></span>
	        			</button>
						<div class="logo">
							<h1><a href="<?php echo URL; ?>"><span>E</span> -Ticaret</a></h1>
						</div>
	    			</div>
	    <!--/.navbar-header-->
	    			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	        			<ul class="nav navbar-nav">
						<li><a href="<?php echo URL; ?>">Anasayfa</a></li>
		        	<?php
		        	$ayarlar->LinkleriGetir();
		        	?>
				
					<li><a href="<?php echo URL; ?>/sayfalar/iletisim">İletişim</a></li>
	        			</ul>
	    			</div>
	    <!--/.navbar-collapse-->
				</nav>
	<!--/.navbar-->
			</div>
		</div>
		