<?php 
require_once __DIR__ . '/_header.php'; 


if( isset($msg) ){
    echo $msg . '<br>';
}
?>
<hr>
<br>
<ul class="products">

    <?php

   // $trgovineList=['Konzum', 'Spar'];
        $temp=[];
        if($trgovineList !== $temp)
        {
            foreach($trgovineList as $trgovina)
            {
                
                echo '<li class="products" >';
                echo '<a href="index.php?rt=trgovine/recenzije&imeTrgovine='.$trgovina.'">';
                echo $trgovina.'<br><br>';
                echo '</a>';   
            }
    }

    ?>
    </ul>

<?php  require_once __DIR__ . '/_footer.php' ?>