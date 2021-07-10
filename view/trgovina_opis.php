<?php 
require_once __DIR__ . '/_header.php'; 


if( isset($msg) ){
    echo $msg . '<br>';
}
?>

<strong class="podnaslov">
    <?php 
    if($imeTrgovine!== "")
        echo 'Dobrodočli u trgovinu:  <strong style="color:firebrick">'.$imeTrgovine.'</strong><br>';
    echo 'Ocjena ove trgovine: <strong style="color:firebrick">'.$ocjena.'</strong><br>';
    ?> 
</strong>


<?php

echo '<a href="index.php?rt=trgovine/sviProizvodi&imeTrgovine='.$imeTrgovine.'" >';
echo '<p >Dostupni proizvodi'.'</p><br><br>';
echo '</a>'; 

?>
<strong class="podnaslov">
<h2> Komentari naših kupaca:</h2>
</strong>

<?php
    foreach($recenzijeList as $user=>$recenzija)
    {
        
        echo '<h2 class="ime">'.$user.'</h2>';
        echo '<h3 class="comment">'.$recenzija->komentar.'<br>';
        echo 'Ocjena: '.$recenzija->ocjena.'/5</h3>';
    }

    
 require_once __DIR__ . '/_footer.php' ?>