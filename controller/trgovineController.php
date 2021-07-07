<?php
require_once __DIR__.'/../model/specerajservice.class.php';
class TrgovineController{


    public function index()
    {

        //$trgovineList=['Konzum', 'Spar'];
        $trgovineList = SpecerajService::getTrgovine();
        require_once __DIR__.'/../view/trgovine_index.php';
    }

    public function sviProizvodi()
    {

        $imeTrgovine = $_GET['imeTrgovine'];
        $idTrgovine = SpecerajService::getTrgovinaId($imeTrgovine);
        $productList = SpecerajService::getProductsByStore($idTrgovine);
        require_once __DIR__.'/../view/products_index.php';
    }
    
};

?>