<?php require 'views/header.php'; ?>

		<!-- checkout -->
<div class="cart-items">
	<div class="container">
	 <?php
			if(!isset($_COOKIE["urun"])){
				echo' <h2> SEPETİNİZ BOŞ.</h2>
		<div class="cart-gd">';
	}else{
		
        echo' <h2><a href="'.URL.'/GenelGorev/SepetiBosalt" class="btn btn-sm btn-danger">Sepeti Bosalt</a>SEPETİNİZDEKİ ÜRÜN - '.count($_COOKIE["urun"]).'</h2>
		<div class="cart-gd">';
       
		
			if (isset($_COOKIE["urun"])) :
		
			$toplamAdet=0;
			$toplamFiyat=0;
				 echo "<form id=GuncelForm >";
				foreach ($_COOKIE["urun"] as $id => $adet) :
				
				
				$GelenUrun=$ayarlar->UrunCek($id);
				
				 //	$id db ye ilgili ürünü çekicem ve listelicem
				
				echo' <div class="cart-header">
				 <div class="close1">
				 
				
				 
				  <input type="button" class="btn btn-sm btn-success" data-value="'.$GelenUrun[0]["id"].'" value="GÜNCELLE"> '?>
				   <a onclick='UrunSil("<?php echo $GelenUrun[0]["id"]?>","sepetsil")' class="btn btn-sm btn-danger">SİL</a> 
				  <?php echo'</div>
				 <div class="cart-sec simpleCart_shelfItem">
						<div class="cart-item cyc">
							 <img src="'.URL.'/views/design/images/'.$GelenUrun[0]["res1"].'" class="img-responsive" alt="'.$GelenUrun[0]["urunad"].'">
						</div>
					   <div class="cart-item-info">
						<h3><a href="#"> '.$GelenUrun[0]["urunad"].' </a></h3>
						
						<ul class="qty">
							<li><h3>Ürün Fiyat</h3>
							<span>'.number_format($GelenUrun[0]["fiyat"],2,'.',',').'</span></li>
							<li><h3>Ürün Adet</h3>
							
		  <input type="number" min="1" max="10" value="'.$adet.'" name="adet'.$GelenUrun[0]["id"].'" class="form-control" /> 
	
		  
							</li>
						</ul>
							 <div class="delivery" >
							
							 <span>Toplam Fiyat : '.number_format($GelenUrun[0]["fiyat"]*$adet,2,',','.').'</span>
							 <div class="clearfix"></div>
				        </div>	
					   </div>
					   <div class="clearfix"></div>
											
				  </div>
			 </div>';

			 $toplamAdet +=$adet;
			 $toplamFiyat += $GelenUrun[0]["fiyat"]*$adet;
				
				endforeach;

				echo "</form>";
				
				echo '
				
				<div class="row toplamAlan_2">
				<div class="col-md-12">	TOPLAM : '.number_format($toplamFiyat,2,',','.').'</div>
				
				</div>
				
			
				
				<div class="row toplamAlan">
				<div class="col-md-12">
				
				<a href="'.URL.'" class="btn btn_1">ALIŞVERİŞE DEVAM ET</a>
				<a href="'.URL.'/sayfalar/siparisitamamla" class="btn btn_1">SİPARİŞİ TAMAMLA</a>
				
				
				
				</div>
				
				</div>';
		
		
	
		
		endif;
	
		}
		?>
        
            
				
              
              
              
		</div>
	</div>
</div>

<!-- //checkout -->	




<?php require 'views/footer.php'; ?> 		
        
        
        
       