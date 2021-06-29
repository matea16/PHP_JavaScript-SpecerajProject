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

        $temp=[];
        if($productList !== $temp)
        {
            foreach($productList as $product)
            {
                
                echo '<li class="products">';
                echo $product->name.'<br><br>';
                echo $product->price.'kn<br><br>';
                echo '-'.$product->akcija.'%<br></li>'; 
                echo '</a>';   
            }
    }

    ?>
    </ul>

<?php  require_once __DIR__ . '/_footer.php' ?>