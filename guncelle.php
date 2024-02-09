<?php
if ( $_POST ):
    require_once 'appidconfig.php';
    $id = $_POST['id'];
    $deger = $_POST['deger'];

    $guncelle = DB::get('UPDATE appids SET cekildi = ? WHERE id = ?',array($deger,$id));

    if ( DB::getLastError() ) {
        echo 'Güncelleme Hata Var!';
        print_r(DB::getLastError());
    } else {
        echo '<script>location.href="appbot.php"</script>';
    };

else:
    echo 'Post işlemi değil';
endif;