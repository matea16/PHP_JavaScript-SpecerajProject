<?php

require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ .'/product.class.php';
require_once __DIR__ .'/recenzije.class.php';
require_once __DIR__ .'/user.class.php';


class SpecerajService{

    public static function getProductById($id_product)
    {
        $db=DB::getConnection();
        $st=$db->prepare('SELECT * FROM projekt_products WHERE id=:id');
        $st->execute(['id'=>$id_product]);

        $row=$st->fetch();
        return new Product($row['id'], $row['id_trgovina'],$row['name'],$row['akcija'], $row['price']);

    }

    public static function getProductsOnAkcija()
    {
        $db=DB::getConnection();
        $st=$db->prepare('SELECT * FROM projekt_products');
        $st->execute([]);

        $products=[];
        while($row =$st->fetch())
        {
            $id_product=$row['id'];
            if($row['akcija'] !== null)
                $products[]=SpecerajService::getProductById($id_product);
        }

        return $products;
    }

    public static function findProducts($key_words)
    {
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM projekt_products');
        $st->execute();
        $proizvodi=$st->fetchAll();
        $products=[];
        
        foreach($proizvodi as $proizvod)
        {
            foreach($key_words as $word)            
            {
                $ime=strtolower($proizvod['name']);
                if(strpos($ime, $word) !== false)
                {
                    $id=$proizvod['id'];
                    $products[]=SpecerajService::getProductById($id);
                    break;
                }

            }
        }
        return $products;
    }

    public static function sortirajProizvode($productList, $kako)
    {
        if ($kako === 'uzlazno')
            $products= SpecerajService::sortirajUzlazno($productList);
        else if ($kako === 'silazno')
            $products= SpecerajService::sortirajSilazno($productList);

        return $products;
        
    }

    public static function izracunajCijenu($proizvod)
    {
        if($proizvod->akcija!== null)
            return round($proizvod->price - ($proizvod->akcija/100)*$proizvod->price, 2);

        else return round($proizvod -> price, 2);
            
        
    }

    public static function sortirajUzlazno($lista)
    {
        for($i = 0; $i<sizeof($lista); ++$i)
        {
            for($j = $i+1; $j<sizeof($lista); ++$j)
            {
                if(SpecerajService::izracunajCijenu($lista[$i]) > SpecerajService::izracunajCijenu($lista[$j]))
                {
                    $temp = $lista[$i];
                    $lista[$i] = $lista[$j];
                    $lista[$j] = $temp;
                }
            }
        }
        return $lista;
    }

    public static function sortirajSilazno($lista)
    {
        for($i = 0; $i<sizeof($lista); ++$i)
        {

            for($j = $i+1; $j<sizeof($lista); ++$j)
            {
                if(SpecerajService::izracunajCijenu($lista[$i]) < SpecerajService::izracunajCijenu($lista[$j]))
                {
                    $temp = $lista[$i];
                    $lista[$i] = $lista[$j];
                    $lista[$j] = $temp;
                }
            }
        }
        return $lista;
    }

     //-----------------------------------------------------
    //za trgovine
    public static function getTrgovine()
    {
        $db=DB::getConnection();
        $st=$db->prepare('SELECT * FROM projekt_trgovine');
        $st->execute();

        $trgovine=[];
        while($row =$st->fetch())
        {
            $trgovine[]=$row['name'];
        }

        return $trgovine;

    }

    public static function getTrgovinaId($imeTrgovine)
    {
        $db=DB::getConnection();
        $st=$db->prepare('SELECT * FROM projekt_trgovine WHERE name=:ime');
        $st->execute(['ime'=>$imeTrgovine]);
        $row=$st->fetch();
        return $row['id'];

    }

    public static function getProductsByStore($idTrgovine)
    {
        $db=DB::getConnection();
        $st=$db->prepare('SELECT * FROM projekt_products WHERE id_trgovina=:id');
        $st->execute(['id'=>$idTrgovine]);

        $products=[];
        while($row =$st->fetch())
        {
            $id_product=$row['id'];
            $products[]=SpecerajService::getProductById($id_product);
        }

        return $products;
    }

    public static function getProductsOnAkcijaByStore($idTrgovine)
    {
        $db=DB::getConnection();
        $st=$db->prepare('SELECT * FROM projekt_products WHERE id_trgovina=:id');
        $st->execute(['id'=>$idTrgovine]);

        $products=[];
        while($row =$st->fetch())
        {
            $id_product=$row['id'];
            if($row['akcija'] !== null)
                $products[]=SpecerajService::getProductById($id_product);
        }

        return $products;

    }

    public static function izracunajOcjenu($imeTrgovine)
    {
        $id = SpecerajService::getTrgovinaId($imeTrgovine);
        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM projekt_recenzije WHERE id_trgovina =:id');
        $st->execute(['id' => $id]);

        $koliko = 0;
        $zbroj = 0;
        while($row =$st->fetch())
        {
            $zbroj+=$row['ocjena'];
            $koliko++;
        }
        if($koliko !== 0)
        {
        $ocjena = $zbroj/$koliko;
        return $ocjena;
        }
        else return -1;
        
    }


    public static function getNajpovoljnijaTrgovina($proizvodi, $c)
    {
        $sveTrgovine = SpecerajService::getTrgovine();
        $id0=SpecerajService::getTrgovinaId($sveTrgovine[0]);

        $db = DB::getConnection();
        $st = $db->prepare('SELECT * FROM projekt_products WHERE id_trgovina =:id AND name=:ime');

        $cijena = 0;

        foreach($proizvodi as $proizvod)
        {
            $st->execute(['id' => $id0, 'ime' => $proizvod]);
            $pom = $st->fetch();
            $pom2=SpecerajService::getProductById($pom['id']);
            $cijena += SpecerajService::izracunajCijenu($pom2);

        }

        $minCijena = $cijena;
        $minTrgovina = $sveTrgovine[0];

        for($i = 1; $i < sizeof($sveTrgovine); ++$i)
        {
            $cijena = 0;
            foreach($proizvodi as $proizvod)
            {
                $id=SpecerajService::getTrgovinaId($sveTrgovine[$i]);
                $st->execute(['id' => $id, 'ime' => $proizvod]);
                $pom = $st->fetch();
                $pom2=SpecerajService::getProductById($pom['id']);
                $cijena += SpecerajService::izracunajCijenu($pom2);
    
            }

            if($cijena < $minCijena)
            {
                $minCijena = $cijena;
                $minTrgovina = $sveTrgovine[$i];
            }

        }
        if($c === 0)
            return $minTrgovina;
        else 
            return $minCijena;


    }
    //-------------------------------------------------------------
    //za Login
    public static function Login($username, $password){

        $db = DB::getConnection();
        echo $username;
        $st = $db->prepare('SELECT password_hash FROM projekt_users WHERE username =:username');
        $st->execute(['username' => $username]);

        if( $st->rowCount() !== 1){
            $return_state = false;
        }
        elseif( password_verify( $password, $st->fetch()["password_hash"] ) ){
            $return_state = true;
        }
        else{
            $return_state = false;
        }

        if($return_state){
            $secret_word = 'Monstruozno';
            $_SESSION['login'] = $username . ',' . md5( $username . $secret_word);
            $_SESSION['username'] = $username;
        }
        return $return_state;
    }

    public static function SignUp($username, $password, $email){
        $db = DB::getConnection();

        $st = $db->prepare( 'INSERT INTO projekt_users(username, password_hash, email, registration_sequence, has_registered) VALUES (:username, :password, :email, \'abc\', \'1\')' );
        $st->execute( array( 'username' => $username, 'password' => password_hash( $password, PASSWORD_DEFAULT ), 'email' => $email ) );

        if( $st->rowCount() !== 1){
            $return_state = false;
        }
        else{
            $return_state = true;
        }

        if($return_state){
            $secret_word = 'Monstruozno';
            $_SESSION['login'] = $username . ',' . md5( $username . $secret_word);
            $_SESSION['username'] = $username;
        }
        return $return_state;
    }

    function logout(){

        session_unset();
        session_destroy();
    }

    //-----------------------------------------------------------------------
    //za korisnika

    public static function getUserId($username)
    {
        $db=DB::getConnection();
        $st=$db->prepare('SELECT * FROM projekt_users WHERE username=:username');
        $st->execute(['username'=>$username]);
        $row=$st->fetch();
        return $row['id'];
    }

    public static function getUserById($id_user)
    {
        $db=DB::getConnection();
        $st=$db->prepare('SELECT * FROM projekt_users WHERE id=:id');
        $st->execute(['id'=>$id_user]);

        $row=$st->fetch();
        return new User($row['id'], $row['username'],$row['password_hash'],$row['email'], $row['registration_sequence'],$row['has_registered']);

    }

    // public static function getOwnedProducts($user_id)
    // {
    //     $db=DB::getConnection();
    //     $st=$db->prepare('SELECT * FROM projekt_ WHERE id_user=:id_user');
    //     $st->execute(['id_user'=>$user_id]);

    //     $products=[];
    //     while($row =$st->fetch())
    //     {
    //         $id_product=$row['id'];
    //         $products[]=SpecerajService::getProductById($id_product);
    //     }

    //     return $products;
    // }


    //----------------------------------------
    //za recenzije
    public static function getRecenzijaByTrgovina($idTrgovine)
    {
        $db=DB::getConnection();
        $st=$db->prepare('SELECT * FROM projekt_recenzije WHERE id_trgovina=:id');
        $st->execute(['id'=>$idTrgovine]);

        $recenzije=[];
        while($row =$st->fetch())
        {
            $id_recenzija=$row['id'];
            if($row['komentar'] !== null || $row['ocjena'] !== null)
                $recenzije[]=SpecerajService::getRecenzijaById($id_recenzija);
        }
        return $recenzije;
    }


    public static function getRecenzijaById($id_recenzija)
    {
        $db=DB::getConnection();
        $st=$db->prepare('SELECT * FROM projekt_recenzije WHERE id=:id'); 
        $st->execute(['id'=>$id_recenzija]);

        $row=$st->fetch();
        return new Recenzija($row['id'], $row['id_trgovina'],$row['id_user'],$row['ocjena'],$row['komentar']);

    }

    public static function addComment($comment, $rating, $user_id, $idTrgovine){
        try{
                 
                 $db = DB::getConnection();
                 $st = $db->prepare( 'INSERT INTO projekt_recenzije(id_user, id_trgovina, ocjena, komentar) VALUES (:id_user, :id_trgovina, :ocjena, :komentar)' );
     
                 $st->execute( array( 'id_user' => $user_id, 'id_trgovina' => $idTrgovine, 'ocjena' =>$rating , 'komentar' => $comment ) );
        }
        catch( PDOException $e ) { exit( "PDO error: " . $e->getMessage() ); }
     }


}


?>