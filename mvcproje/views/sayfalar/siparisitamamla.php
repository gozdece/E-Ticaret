<?php require 'views/header.php';  ?>


<?php

/* BU SAYFANIN GÖRÜNTÜLENMESİNDE OTURUM KONTROLÜ YANI SIRA SEPETTE ÜRÜN VARMI DİYE KONTROL
EDİLECEK VE SEPETTE ÜRÜN YOK İSE BU SAYFA GÖRÜNTÜLENEMEYECEK */ 
if(isset($_COOKIE["urun"])){
    if (Session::get("kulad") && Session::get("uye")) : 
        Session::OturumKontrol(Session::get("kulad"),Session::get("uye"));
        ?>

    <div class="container" id="sipTamamlaİskelet" >
        
        <div class="row">
            <div class="col-md-7" id="soltaraf">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row" id="uyelik">
                                <?php $ayarlar->Uyebilgilerinigetir();?>
                                <div class="col-md-12"><h4>ÜYELİK BİLGİLERİ</h4></div>
                                <form action="<?php echo URL;?>/uye/siparisTamamlandi" method="post">
                                <div class="col-md-3" id="label">Ad</div>
                                 <div class="col-md-9" id="input"><?php Form::Olustur("2",array("type"=>"text","id"=>"sipAd","name"=>"ad","value"=>$ayarlar->uyebilgileri[0]["ad"],"class"=>"form-control"))?></div>
                                 <div class="col-md-3" id="label">Soyad</div>
                                 <div class="col-md-9" id="input"><?php Form::Olustur("2",array("type"=>"text","id"=>"sipSoyad","name"=>"soyad","value"=>$ayarlar->uyebilgileri[0]["soyad"],"class"=>"form-control"))?></div>
                                 <div class="col-md-3" id="label">Mail</div>
                                 <div class="col-md-9" id="input"><?php Form::Olustur("2",array("type"=>"text","id"=>"sipMail","name"=>"mail","value"=>$ayarlar->uyebilgileri[0]["mail"],"class"=>"form-control"))?></div>
                                 <div class="col-md-3" id="label">Telefon</div>
                                 <div class="col-md-9" id="input"><?php Form::Olustur("2",array("type"=>"text","id"=>"sipTelefon","name"=>"telefon","value"=>$ayarlar->uyebilgileri[0]["telefon"],"class"=>"form-control"))?></div>
                                 <div class="col-md-12"><?php Form::Olustur("2",array("type"=>"radio","name"=>"bilgiTercih","value"=>0,"checked"=>"checked"))?>Üyelik bilgilerimi kullan</div>
                                 <div class="col-md-12"><?php Form::Olustur("2",array("type"=>"radio","name"=>"bilgiTercih","value"=>1))?>Farklı bilgiler kullan</div>
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <div class="row" id="uyelik">
                            <div class="col-md-12"><h4>ADRESLER</h4></div>
                            <?php
                            $adresler = $ayarlar->Uyeadreslerinigetir();
                            foreach ($adresler as $deger) {
                                echo '<div class="col-md-12" id="adresSatir">
                                <div class="row">
                                <div class="col-md-9">'.$deger["adres"].'</div>
                                <div class="col-md-3">';?>
                                <?php
                                if($deger["varsayilan"]==1):
                                    Form::Olustur("2",array("type"=>"radio","name"=>"adresTercih","value"=>$deger["id"]));
                                else:
                                    Form::Olustur("2",array("type"=>"radio","name"=>"adresTercih","value"=>$deger["id"]));
                                endif;
                                echo '
                                </div>
                                </div>
                                </div>'; 
                            }
                            


                            ?>
                            
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row" id="uyelik">
                                <div class="col-md-12"><h4>ÖDEME YÖNTEMİ</h4></div>
                                <div class="col-md-6" id="adresSatir">
                                    <label>
                                        <?php
                                        Form::Olustur("2",array("type"=>"radio","value"=>"1","name"=>"odeme"));
                                        ?>HAVALE/EFT
                                    </label>
                                </div>
                                <div class="col-md-6" id="adresSatir">
                                    <label>
                                        <?php
                                        Form::Olustur("2",array("type"=>"radio","value"=>"0","name"=>"odeme","disabled"=>"disabled"));
                                        ?>KREDİ KARTI(YAKINDA)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-5">
                <div class="row" id="sagtaraf">
                        
                        <div class="col-md-12" id="baslik"><h3>SEPETTEKİ ÜRÜNLERİNİZ</h3></div>
                        <div class="col-md-3" id="icbaslik">Ürün Ad</div>
                        <div class="col-md-3" id="icbaslik">Adet</div>
                        <div class="col-md-3" id="icbaslik">Birim Fiyat</div>
                        <div class="col-md-3" id="icbaslik">Toplam</div>
                        <?php
                        $toplamAdet=0;
                        $toplamFiyat=0;
                        foreach ($_COOKIE["urun"] as $id => $adet) {
                            $GelenUrun=$ayarlar->UrunCek($id);
                            echo '
                            <div class="col-md-3" id="icurunler">'.$GelenUrun[0]["urunad"].'</div>
                            <div class="col-md-3" id="icurunler">'.$adet.'</div>
                            <div class="col-md-3" id="icurunler">'.$GelenUrun[0]["fiyat"].'</div>
                            <div class="col-md-3" id="icurunler">'.$GelenUrun[0]["fiyat"]*$adet.'</div>
                            ';
                            $toplamAdet +=$adet;
                            $toplamFiyat+=$GelenUrun[0]["fiyat"]*$adet;
                        }
                        ?>
                        <div class="col-md-3" id="icurunler">Toplam Adet</div>
                        <div class="col-md-3" id="icurunler"><?php echo $toplamAdet;?></div>
                        <div class="col-md-3" id="icurunler">Toplam Fiyat</div>
                        <div class="col-md-3" id="icurunler"><?php echo $toplamFiyat;?></div> 
                </div>
                <div class="col-md-12">
                <?php
                Form::Olustur("2",array("type"=>"hidden","value"=>$toplamFiyat,"name"=>"toplam"));
                Form::Olustur("2",array("type"=>"submit","value"=>"Tamamla","class"=>"btn btn-primary"));
                if(isset($veri["bilgi"])){
                    echo $veri["bilgi"];
                }
                ?>
                </form>
                </div>
            </div>
        </div>
        
    </div>

    <?php
    else:
    
        header("Location:".URL);
    
    endif;
    
}else{

    header("Location:".URL);    
}

?>
<?php require 'views/footer.php'; ?> 		
        
        
        
       