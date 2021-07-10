<?php

require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ .'/product.class.php';


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
            return $proizvod->price - ($proizvod->akcija/100)*$proizvod->price;

        else return $proizvod -> price;
            
        
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

    public static function getOwnedProducts($user_id)
    {
        $db=DB::getConnection();
        $st=$db->prepare('SELECT * FROM projekt_products WHERE id_user=:id_user');
        $st->execute(['id_user'=>$user_id]);

        $products=[];
        while($row =$st->fetch())
        {
            $id_product=$row['id'];
            $products[]=SpecerajService::getProductById($id_product);
        }

        return $products;
    }


}


?>