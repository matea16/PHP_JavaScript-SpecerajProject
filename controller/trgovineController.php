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
        $keyWord = "";
        $naAkciji = "";
        require_once __DIR__.'/../view/products_index.php';
    }

    public function naAkciji()
    {
        $imeTrgovine = $_GET['imeTrgovine'];
        $idTrgovine = SpecerajService::getTrgovinaId($imeTrgovine);
        $productList = SpecerajService::getProductsOnAkcijaByStore($idTrgovine);
        $keyWord = "";
        $naAkciji = "naAkciji";
        require_once __DIR__.'/../view/products_index.php';
    }


    public function recenzije()
    {

        $imeTrgovine = $_GET['imeTrgovine'];
        $ocjena = SpecerajService::izracunajOcjenu($imeTrgovine);
        $idTrgovine = SpecerajService::getTrgovinaId($imeTrgovine);
        $recenzije=SpecerajService::getRecenzijaByTrgovina($idTrgovine);
        $recenzijeList = [];

        foreach($recenzije as $recenzija)
        {
            $user=SpecerajService::getUserById($recenzija->id_user);
            $recenzijeList[$user->username]=$recenzija;    
        }
        $keyWord = "";
        require_once __DIR__.'/../view/trgovina_opis.php';
    }

    public function najpovoljnija()
    {
        $p = $_GET['data'];
        $proizvodi = explode(',',$p);    
        $najpovoljnija = SpecerajService::getNajpovoljnijaTrgovina($proizvodi, 0);
        $najpovoljnijaCijena = SpecerajService::getNajpovoljnijaTrgovina($proizvodi, 1);
        $najpovoljnijaPoruka = 'Trgovina sa najpovoljnijom cijenom za Vašu košaricu je: '.$najpovoljnija
                                .'!<br> Ukupna cijena je: '.$najpovoljnijaCijena.'kn<br><br>';

        require_once __DIR__ . '/../view/kosarica_index.php';
    }
    
};

?>