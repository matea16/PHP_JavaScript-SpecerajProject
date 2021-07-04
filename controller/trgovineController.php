<?php
require_once __DIR__.'/../model/specerajservice.class.php';
class TrgovineController{


    public function index()
    {

        //$trgovineList=['Konzum', 'Spar'];
        $trgovineList = SpecerajService::getTrgovine();
        require_once __DIR__.'/../view/trgovine_index.php';
    }
    
};

?>