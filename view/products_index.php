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

<strong class="podnaslov">
    <?php 
    if($keyWord !== "")
        echo 'Traženi proizvod:  <strong style="color:firebrick">'.$keyWord.'</strong>';
    ?> 
</strong>
<ul class="products">

    <?php
        $temp=[];
        if($productList !== $temp)
        {
            ?>
                <form action="index.php?rt=products/sortiraj&ime=<?php echo $imeTrgovine ?>&keyWord=<?php echo $keyWord ?>
                &naAkciji=<?php echo $naAkciji ?>" method="post">
                <strong class="podnaslov" > Sortiraj po: 
                <select name="kako">
                                <option value="uzlazno"> Cijena uzlazno </option>
                                <option value="silazno"> Cijena silazno </option>
                            </select>
                <button type="submit" class="sort"> Sortiraj! </button>
        </strong>
                <br><br>

            <?php
            foreach($productList as $product)
            {
                
                echo '<li class="products">';
                echo '<p id = "pr_'.$product->id.'">'.$product->name.'</p>';               
                if ($product->akcija !== null)
                {
                    $newPrice = round($product->price - ($product->akcija/100)*$product->price, 2);
                    echo '<span class="novo">-'.$product->akcija.'% </span>';
                    echo '<p class="akcija">'.$product->price.'kn</p>';
                    echo 'Sada samo: <span class="novo">'.$newPrice.'kn</span></li>';
                }
                else
                    echo '<p>'.$product->price.'kn</p>';
                    echo '<button id="'.$product->id.'"class = "dodajUkosaricu" onClick="dodaj_proizvod(this.id)">'.'Dodaj u košaricu</button>';
                    echo '</a>';   
            }
    }

    ?>
    </ul>

<?php  require_once __DIR__ . '/_footer.php' ?>