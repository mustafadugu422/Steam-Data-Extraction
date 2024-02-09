<?php
require_once 'appidconfig.php';
$fgc = file_get_contents("https://store.steampowered.com/search/?category1=998&os=win&hidef2p=1&filter=comingsoon&ndl=1");


   $parcala7 = explode('<a href="https://store.steampowered.com/app/">',$fgc);
   $parcala8 = explode('<a href="https://store.steampowered.com/app/',$parcala7[0]);
  for ($i=1; $i<51 ; $i++) { 
   $parcala9 = explode('<img src="https://cdn.cloudflare.steamstatic.com/steam/apps/ </div>', $parcala8[$i]);   
   $parcala10 = explode('>',$parcala9[0]);
   $tez8 = explode('/',$parcala10[0]);
   
   $id = $tez8[0];
   $oyunadi = $parcala10[7];

   $sql1 = DB::get("SELECT * FROM appids WHERE appid = '$id'");
  if(empty($sql1)){
    $ekle = DB::insert('INSERT INTO appids (appid) VALUES (?)', array($id));
    echo '<h1 style="color: green">'.$id.'</h1>';
  }else{
    echo '<h1 style="color: red">'.$id.'</h1>';
    
  }
   ;
  }
   


   

   
   



?>