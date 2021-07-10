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
            $_POST['proizvodi'] = $productList;
            ?>
            
                <form action="index.php?rt=products/sortiraj" method="post">
                Sortiraj po: <select name="kamo">
                                <option value="uzlazno"> Cijena uzlazno </option>
                                <option value="silazno"> Cijena silazno </option>
                            </select>
                <button type="submit"> Sortiraj! </button>


            <?php
            foreach($productList as $product)
            {
                
                echo '<li class="products">';
                echo $product->name.'     ';               
                if ($product->akcija !== null)
                {
                    $newPrice = $product->price - ($product->akcija/100)*$product->price;
                    echo '<span class="novo">-'.$product->akcija.'% </span>';
                    echo '<p class="akcija">'.$product->price.'kn</p>';
                    echo 'Sada samo: <span class="novo">'.$newPrice.'kn</span></li>';
                }
                else
                    echo '<p>'.$product->price.'kn</p>';
                echo '<button id="dodajUkosaricu">Dodaj u košaricu</button>';
                echo '</a>';   
            }
    }

    ?>
    </ul>

<?php  require_once __DIR__ . '/_footer.php' ?>