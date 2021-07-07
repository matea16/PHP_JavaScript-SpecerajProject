<?php
require_once __DIR__.'/../model/specerajservice.class.php';
class ProductsController{


    public function index()
    {

    }

    public function search()
    {

        require_once __DIR__.'/../view/search_index.php';
    }

    public function searchProducts()
        {
            if(isset($_POST['search']))
            {

                $looking  = $_POST['search'];
                $string = trim(preg_replace('!\s+!', ' ', $looking));
                $key_words = explode(" ", $string);
                $productList=SpecerajService::findProducts($key_words);
                $imeTrgovine="";
                require_once __DIR__.'/../view/products_index.php';

            }

            else{
                require_once __DIR__.'/../view/search_index.php';
            }
        }
    
};

?>