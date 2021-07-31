<?php require 'views/header.php';  ?>


<?php if (Session::get("kulad") && Session::get("uye")) : 
Session::OturumKontrol(Session::get("kulad"),Session::get("uye"));

?>

    <div class="container" id="UyeCont">
    
        <div class="row">
        
            <div class="col-md-2" id="menu">
            
                <div class="row" id="uyepanel">
                
                    <div class="col-md-12" id="baslik">İŞLEMLER</div>
                    <ul>
           <li><a href="<?php echo URL; ?>/uye/siparislerim">Siparislerim</a></li>
           <li><a href="<?php echo URL; ?>/uye/hesapayarlarim">Hesap Ayarları</a></li>
           <li><a href="<?php echo URL; ?>/uye/sifredegistir">Şifre İşlemleri</a></li>
           <li><a href="<?php echo URL; ?>/uye/adreslerim">Adreslerim</a></li>
           <li><a href="<?php echo URL; ?>/uye/yorumlarim">Ürün Yorumlarım</a></li>
           <li><a href="<?php echo URL; ?>/uye/cikis">Oturumu Kapat</a></li>
                        
                    </ul>
                
                
                </div>
                
            
            
            </div>
            
            
        <div class="col-md-10">
          <div class="alert alert-success text-center" id="Sonuc"></div>
        <?php
        
    
        
        
        foreach ($veri as $key => $deger) :     
        
        
                switch ($key) :
                
                case "yorumlar":                
                $ayarlar->UyeyorumGetir($veri["yorumlar"]);
                break;              
                
                case "adres":               
                $ayarlar->UyeadresGetir($veri["adres"]);             
                break;
                
                case "ayarlar":                 
                if (isset($veri["bilgi"])) :
                echo $veri["bilgi"];
                endif;                                      
                $ayarlar->UyeayarlarGetir($veri["ayarlar"]);            
                break;
                
                case "sifredegistir":   
                if (isset($veri["bilgi"])) :
                echo $veri["bilgi"];
                endif;                      
                $ayarlar->Uyesifredegistir($veri["sifredegistir"]);
                break;
                                
                case "siparisler":      
                $ayarlar->UyesiparisGetir($veri["siparisler"]);
                break;      
                
                                
                
                
                endswitch;
        
        
        endforeach;
        
        
        
        ?>
        
        
        </div>

        
        </div>
    
    
    
</div>

<?php
else:
    
    header("Location:".URL);
    
    endif;
?>


<?php require 'views/footer.php'; ?>        
        
        
        
       