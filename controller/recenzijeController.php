<?php
require_once __DIR__.'/../model/specerajservice.class.php';
class RecenzijeController{


    public function index()
    {
        if( isset($_POST['comment']) && isset($_POST['rating']) )
            {
                if($_POST['comment'] !== '' && $_POST['rating'] !== '' && $_POST['comment'] !== null)
                {
                    $comment = $_POST['comment'];
                    $rating = $_POST['rating'];
                    $USERNAME=$_GET['username'];
                    $imeTrgovine=$_GET['imeTrgovine'];
                    $ocjena = SpecerajService::izracunajOcjenu($imeTrgovine);
                    $idTrgovine = SpecerajService::getTrgovinaId($imeTrgovine);
                    $user_id=SpecerajService::getUserId($USERNAME);
                    SpecerajService::addComment($comment, $rating, $user_id, $idTrgovine);

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
                else{
                    $imeTrgovine=$_GET['imeTrgovine'];
                    $USERNAME=$_GET['username'];
                    $ocjena = SpecerajService::izracunajOcjenu($imeTrgovine);

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
            }
    }

    
};

?>