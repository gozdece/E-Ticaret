<?php require 'views/header.php'; ?>
<div class="registration-form">
	<div class="container">
	<div class="dreamcrub">
			   	 <ul class="breadcrumbs">
                    <li class="home">
                       <a href="<?php echo URL; ?>" title="Anasayfa">Anasayfa</a>&nbsp;
                       <span>&gt;</span>
                    </li>
                    <li class="women">
                       Üye Ol
                    </li>
                </ul>
                <ul class="previous">
                	<li><a href="<?php echo URL; ?>">Geri Dön</a></li>
                </ul>
                <div class="clearfix"></div>
			   </div>

		<?php 

		if (isset($veri["bilgi"])) {
			echo $veri["bilgi"];
		}

		if (isset($veri["hata"])) {
			echo '<div class="alert alert-danger mt-5">';
			foreach ($veri["hata"] as $value) {
				echo $value."<br>";}
				echo '</div>';
		}?>

		<h2>Üye Kayıt Formu</h2>
		<div class="registration-grids">
			<div class="reg-form">
				<div class="reg">
					 <p>Welcome, please enter the following details to continue.</p>
					 
					 <?php
					 Form::Olustur("1",array(
					 	"action" => URL."/uye/kayitKontrol",
					 	"method" => "POST"
					 ));
					 ?>
						 <ul>
							 <li class="text-info">Ad: </li>
							 <li><?php Form::Olustur("2",array("type" => "text","required" => "required","name" =>"ad"));?></li>
						 </ul>
						 <ul>
							 <li class="text-info">Soyad: </li>
							 <li><?php Form::Olustur("2",array("type" => "text","required" => "required","name" =>"soyad"));?></li>
						 </ul>				 
						<ul>
							 <li class="text-info">Email: </li>
							 <li><?php Form::Olustur("2",array("type" => "text","required" => "required","name" =>"email"));?></li>
						 </ul>
						 <ul>
							 <li class="text-info">Şifre: </li>
							 <li><?php Form::Olustur("2",array("type" => "password","required" => "required","name" =>"sifre"));?></li>
						 </ul>
						 <ul>
							 <li class="text-info">Tekrar şifre:</li>
							 <li><?php Form::Olustur("2",array("type" => "password","required" => "required","name" =>"sifreTekrar"));?></li>
						 </ul>
						 <ul>
							 <li class="text-info">Telefon Numarası:</li>
							 <li><?php Form::Olustur("2",array("type" => "text","required" => "required","name" =>"telNo"));?></li>
						 </ul>
						 <?php Form::Olustur("2",array("type" => "submit","value" => "KAYIT OL"));?>						
						 <p class="click">By clicking this button, you are agree to my  <a href="#">Policy Terms and Conditions.</a></p> 
					 </form>
				 </div>
			</div>
			<div class="reg-right">
				 <h3>Completely Free Account</h3>
				 <div class="strip"></div>
				 <p>Pellentesque neque leo, dictum sit amet accumsan non, dignissim ac mauris. Mauris rhoncus, lectus tincidunt tempus aliquam, odio 
				 libero tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum. Praesent porttitor lorem dui, in pulvinar enim rhoncus vitae. Curabitur tincidunt, turpis ac lobortis hendrerit, ex elit vestibulum est, at faucibus erat ligula non neque.</p>
				 <h3 class="lorem">Lorem ipsum dolor.</h3>
				 <div class="strip"></div>
				 <p>Tincidunt metus, sed euismod elit enim ut mi. Nulla porttitor et dolor sed condimentum. Praesent porttitor lorem dui, in pulvinar enim rhoncus vitae. Curabitur tincidunt, turpis ac lobortis hendrerit, ex elit vestibulum est, at faucibus erat ligula non neque.</p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php require 'views/footer.php'; ?>