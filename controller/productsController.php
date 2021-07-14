<?php
require_once __DIR__.'/../model/specerajservice.class.php';
class ProductsController{


    public function index()
    {
        $username=$_GET['username'];
        $id=SpecerajService::getUserId($username);
        $keyWord = '';
        $imeTrgovine="";
        $productList=SpecerajService::getProductsOnAkcija();
        $naAkciji = "";
        require_once __DIR__.'/../view/products_index.php';
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
                $naAkciji = "";
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
            $naAkciji =$_GET['naAkciji'];

            $kako =  $_POST['kako'];
            if($imeTrgovine !== "" && $naAkciji!=="")
            {
                $idTrgovine = SpecerajService::getTrgovinaId($imeTrgovine);
                $productList = SpecerajService::getProductsOnAkcijaByStore($idTrgovine);
                $keyWord = "";

            }

            else if($imeTrgovine !== "")
            {
                $idTrgovine = SpecerajService::getTrgovinaId($imeTrgovine);
                $productList = SpecerajService::getProductsByStore($idTrgovine);
                $keyWord = "";

            }

            else if($keyWord !== "" && $imeTrgovine === "" && $naAkciji ==="")
            {
                $looking  = $keyWord;
                $string = trim(preg_replace('!\s+!', ' ', $looking));
                $key_words = explode(" ", $string);
                $productList=SpecerajService::findProducts($key_words);

                $temp = [];
                if($productList === $temp)
                {
                    $productList = SpecerajService::getProductsOnAkcija();
                    $keyWord = "";;
                }

            }

            else{

                $productList=SpecerajService::getProductsOnAkcija();
                $keyWord = "";
            }

            $productList = SpecerajService::sortirajProizvode($productList, $kako);
            require_once __DIR__.'/../view/products_index.php';
        }

        public function kosarica()
        {
            $najpovoljnijaPoruka = '';
            require_once __DIR__.'/../view/kosarica_index.php';


        }
};

?>