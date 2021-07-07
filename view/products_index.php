<?php 
require_once __DIR__ . '/_header.php'; 


if( isset($msg) ){
    echo $msg . '<br>';
}
?>
<hr>
<br>
<strong class="podnaslov">
    <?php 
    if($imeTrgovine!== "")
        echo 'Proizvodi dostupni u trgovini:  <strong style="color:firebrick">'.$imeTrgovine.'</strong>';
    ?> 
</strong>
<ul class="products">

    <?php

        $temp=[];
        if($productList !== $temp)
        {
            foreach($productList as $product)
            {
                
                echo '<li class="products">';
                echo $product->name.'<br><br>';
                echo $product->price.'kn<br><br>';
                if ($product->akcija !== null)
                    echo '-'.$product->akcija.'%<br></li>';
                echo '<button id="dodajUkosaricu">Dodaj u košaricu</button>';
                echo '</a>';   
            }
    }

    ?>
    </ul>

<?php  require_once __DIR__ . '/_footer.php' ?>