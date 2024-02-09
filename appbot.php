<?php
require_once 'appidconfig.php';
error_reporting(1);

$sql = DB::getRow('SELECT * FROM appids WHERE cekildi = 0 ORDER BY RAND() LIMIT 1'); 


$sayii = rand(0, 5);
                

$fgc = file_get_contents("https://store.steampowered.com/app/"."$sql->appid"."/?l=turkish");

$link2 = "https://store.steampowered.com/app/"."$sql->link";
$linkayrik = explode("/", $link2);
$sabit = 'https://cdn.akamai.steamstatic.com/steam/apps/'.$linkayrik[4]."/";

   
   // Oyun Adı
   $parcala = explode('<div id="appHubAppName" class="apphub_AppName">',$fgc);
   $parcala2 = explode( '</div>',$parcala[1]);
   // endOyun Adı

   // Oyun Açıklaması
   $parcala3 = explode('<div class="game_description_snippet">',$fgc);
   $parcala4 = explode( '</div>',$parcala3[1]);
   // endOyun Açıklaması

   // Çıkış Tarihi
   $parcala5 = explode('<div class="date">',$fgc);
   $parcala6 = explode( '</div>',$parcala5[1]);
   // endÇıkış Tarihi

   // İşletim Sistemi
   $parcala7 = explode('<ul class="bb_ul">',$fgc);
   $parcala8 = explode( '</ul>',$parcala7[1]);
   $parcalama8 = explode("<li>", $parcala8[0]);
   $parcalanan8 = explode(' ',$parcalama8[2]);
   // endİşletim Sistemi
  

   
   //Küçük resim
   $parcala19 = explode('<img class="game_header_image_full" src="',$fgc);
   $parcala20 = explode('">',$parcala19[1]);

    //endKüçük resim

   

    echo '<input type="text" value="'.$parcala2[0].' Türkçe Yama" id="oyunadi">'; echo '<button onclick="oyunadi()">Copy text</button><br><br><hr>';
    echo '<input type="text" value='.$parcala20[0].' id="resimlink">'; echo '<button onclick="resimlink()">Copy text</button><br><br><hr>';
    echo '<input type="text" value="https://store.steampowered.com/app/'.$sql->appid.'/?l=turkish" id="appid">'; echo '<button onclick="appid()">Copy text</button><br><br><hr>';



 // Oyun Açıklama echo "<div class='oyunaciklama'>$parcala4[0] </div> <hr><br><br>";


    $link = file_get_contents("https://store.steampowered.com/app/"."$sql->appid");
    $parcala11 = explode('<a class="highlight_screenshot_link"' ,$link);

    echo '<input type="text" value="';
    echo "&lt;h2&gt;";
   for($i=1;$i<count($parcala11);$i++)
   {
       $parcala11 = explode('<a class="highlight_screenshot_link"' ,$link);
       $parcala12 = explode( '</a>',$parcala11[$i]);
       $parcalama12 = explode('"',$parcala12[0]);
       
       echo "&lt;div class='resim$i row'&gt;&lt;img src=".$parcalama12[3]."&gt;&lt;/div&gt;";
   }
   echo "&lt;/h2&gt;";
   echo '" id="myInput">'; echo '<button onclick="aciklama()">Copy text</button> <br><br><hr>';

   $veri = $parcala2[0]; 
    $oyunadi_listesi = array(
        'Game Türkçe Yama',
        'Game Kullanıcı Deneyimleri',
        'Game Sistem Gereksinimleri'
    );

    $metin = '';
    foreach ($oyunadi_listesi as $oyunadi) {
        $metin .= "$veri $oyunadi\n";
    }

    echo '<textarea id="keyw" rows="6" cols="80">'.$metin.'</textarea>'; echo '<button onclick="keyw()">Copy text</button> <br><br><hr>';

    


?>

<br><br>

<form action="guncelle.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $sql->id ?>">
<input type="hidden" name="deger" value="1">

    <button class="btn btn-success" href="bot.php" type="submit">Siteye Eklendi</button>   
  
</form>

  <button onClick="window.location.reload();">Yenile</button>
<script>
function aciklama() {
  
  var copyText = document.getElementById("myInput");

  
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
}
</script>




<script>
function resimlink() {
  
  var copyText = document.getElementById("resimlink");

  
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
}
</script>


<script>
function oyunadi() {
  
  var copyText = document.getElementById("oyunadi");

  
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
}
</script>


<script>
function appid() {
  
  var copyText = document.getElementById("appid");

  
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
}
</script>

<script>
function keyw() {
  
  var copyText = document.getElementById("keyw");

  
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
}
</script>



