<?php
session_start();

require_once __DIR__ . '/../model/specerajservice.class.php';

class LoginController{

    public function index(){
        
        $es = new SpecerajService();

        if( isset($_POST['username']) && isset($_POST['password'])){
            $login = $es->Login($_POST['username'], $_POST['password']);

            if($login === true){
				echo "ok";
                //header( 'Location: index.php?rt=products/index&username='.$_POST['username'] );
            }
            // else{

            //     $msg = 'Neispravno korisničko ime ili lozinka!';

            //     require_once __DIR__ . '/../view/index_index.php';
            // }
        }
        else{

            $msg = 'Niste unijeli potrebne informacije!';

            require_once __DIR__ . '/../view/index_index.php';
        }
    } 

    // public function logout(){

    //     SpecerajService::logout();
    //     header( 'Location: index.php?rt=index' );
    // }

}

?>