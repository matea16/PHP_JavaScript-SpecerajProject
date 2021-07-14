<!DOCTYPE html>
<html>
<head>   
<meta charset="UTF-8">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
   <script type="text/javascript" src="javascript/naslovna.js"></script>
   <script type="text/javascript" src="javascript/javasc.js"></script>
   <script type="text/javascript" src="javascript/kosarica.js"></script>
    <title>Špeceraj</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<canvas width="$(window).width()+70" height="300" id="cnv" style="position: relative; top:0; left:0;"></canvas>
<nav id="navbar">
    <ul>
        <li>
        <a href="index.php?rt=trgovine/index">Trgovine</a> 
        </li>
        <li>
        <a href="index.php?rt=index/index">Proizvodi na akciji</a> 
        </li>
        <li>
        <a href="index.php?rt=products/search">Pretraga</a> 
        </li>
        <li>
        <a href="index.php?rt=products/kosarica">Moja košarica</a>  
        </li>

    </ul>
</nav>
<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION['prijavljen'])){
        if($_SESSION['prijavljen']===true){
            echo '<button id="btn-signout" style="position: absolute; top:60px; left:60px;">Sign out</button>
            <br><br>';
        }
        else{
            echo '<button id="btn-signin" style="position: absolute; top:60px; left:60px;">Sign in</button>
            <br><br>
            <button id="btn-signup" style="position: absolute; top:120px; left:60px;">Sign up</button>';
        }
        
    }
    else{
        echo '<button id="btn-signin" style="position: absolute; top:60px; left:60px;">Sign in</button>
        <br><br>
        <button id="btn-signup" style="position: absolute; top:120px; left:60px;">Sign up</button>';
    }

if($najpovoljnijaPoruka !== '' ){
    echo $najpovoljnijaPoruka . '<br>';
}

?>
<div id="div-popis" class = "div-popis"></div>
<br><br>
<button id="nadi_najpovoljnije">Nađi najpovoljniju trgovinu!</button>
