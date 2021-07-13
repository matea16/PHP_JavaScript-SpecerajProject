<?php
session_start();

require_once __DIR__ . '/../model/specerajservice.class.php';

class LoginController{

    public function index(){

        $_SESSION['prijavljen'] = false;
        $es = new SpecerajService();

        if( isset($_POST['username']) && isset($_POST['password'])){

            $login = $es->Login($_POST['username'], $_POST['password']);

            if($login === true){
                $_SESSION['prijavljen'] = true;
                $_SESSION['username'] =  $_POST['username'];
                header( 'Location: index.php?rt=products/index&username='.$_POST['username'] );
            }
            else{

                $msg = 'Neispravno korisničko ime ili lozinka!';

                require_once __DIR__ . '/../view/index_index.php';
            }
        }
        else{

            require_once __DIR__ . '/../view/index_index.php';
        }
    } 

    public function addUser()
    {
        $_SESSION['prijavljen'] = false;
        $es = new SpecerajService();

        if( isset($_POST['username_signup']) && isset($_POST['password_signup']) && isset($_POST['email'])){
    
            $signup = $es->SignUp($_POST['username_signup'], $_POST['password_signup'], $_POST['email']);

            if($signup === true){
                $_SESSION['prijavljen'] = true;
                $_SESSION['username'] =  $_POST['username_signup'];
                header( 'Location: index.php?rt=products/index&username='.$_POST['username_signup'] );
            }
            else{

                $msg = 'Neispravno korisničko ime ili lozinka!';

                require_once __DIR__ . '/../view/signup_index.php';
            }
        }
        else{

            require_once __DIR__ . '/../view/signup_index.php';
        }

      
    }

    public function logout(){
        $_SESSION['prijavljen'] = false;
        SpecerajService::logout();
        header( 'Location: index.php?rt=index' );
    }

}

?>