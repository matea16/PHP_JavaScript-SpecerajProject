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
                $keyWord = $_POST['search'];
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
    
        public function sortiraj()
        {
            $imeTrgovine  = $_GET['ime'];
            $keyWord = $_GET['keyWord'];

            $kako =  $_POST['kako'];

            if($imeTrgovine !== "")
            {
                $idTrgovine = SpecerajService::getTrgovinaId($imeTrgovine);
                $productList = SpecerajService::getProductsByStore($idTrgovine);

            }

            else if($keyWord !== "")
            {
                $looking  = $keyWord;
                $string = trim(preg_replace('!\s+!', ' ', $looking));
                $key_words = explode(" ", $string);
                $productList=SpecerajService::findProducts($key_words);

            }
            else 
                $productList=SpecerajService::getProductsOnAkcija();

            $productList = SpecerajService::sortirajProizvode($productList, $kako);
            require_once __DIR__.'/../view/products_index.php';
        }
};

?>