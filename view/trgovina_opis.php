<?php 
require_once __DIR__ . '/_header.php'; 


if( isset($msg) ){
    echo $msg . '<br>';
}
?>

<strong class="podnaslov">
    <?php 
    if($imeTrgovine!== "")
        echo 'Dobrodošli u trgovinu:  <strong style="color:firebrick">'.$imeTrgovine.'</strong><br>';
        echo '<a href="index.php?rt=trgovine/naAkciji&imeTrgovine='.$imeTrgovine.'" >';
        echo '<p >  Prikaži proizvode na akciji'.'</p><br>';
        echo '</a>'; 
        if($ocjena !== -1)
            echo 'Ocjena ove trgovine: <strong style="color:firebrick">'.$ocjena.'</strong><br>';
        else echo 'Ova trgovina nema još recenzija!'
    ?> 
</strong>


<?php

echo '<a href="index.php?rt=trgovine/sviProizvodi&imeTrgovine='.$imeTrgovine.'" >';
echo '<p >Dostupni proizvodi'.'</p><br><br>';
echo '</a>'; 


if($ocjena !== -1)
{

    echo '<strong class="podnaslov">
    <h2> Komentari naših kupaca:</h2>
    </strong>';
    foreach($recenzijeList as $user=>$recenzija)
    {
        
        echo '<h2 class="ime">'.$user.'</h2>';
        echo '<h3 class="comment">'.$recenzija->komentar.'<br>';
        echo 'Ocjena: '.$recenzija->ocjena.'/5</h3>';
    }

}

if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
if(isset($_SESSION['prijavljen'])){
        if($_SESSION['prijavljen']===true){
                ?> <h2> Ostavi svoj komentar: <br> </h2>


                <form action="index.php?rt=recenzije/index&username=<?php echo $_SESSION['username'] ?>&imeTrgovine=<?php echo $imeTrgovine ?>" method="post">
                Odaberi ocjenu: 
                <select name="rating">
                                    <option value="1"> 1 </option>
                                    <option value="2"> 2 </option>
                                    <option value="3"> 3 </option>
                                    <option value="4"> 4 </option>
                                    <option value="5"> 5</option>
                                </select>
                <br><br>
                Unesi komentar: <input type="text" name="comment"> 
                
                <button type="submit"> Komentiraj </button>
                <?php
            }
        else{
            echo '<a href="index.php?rt=login/index" >';
            echo '<p >Prijavi se i ostavi komentar!'.'</p><br><br>';
            echo '</a>'; 
            }
}

else{
    echo '<a href="index.php?rt=login/index" >';
    echo '<p >Prijavi se i ostavi komentar!'.'</p><br><br>';
    echo '</a>'; 
}
    
 require_once __DIR__ . '/_footer.php' ?>