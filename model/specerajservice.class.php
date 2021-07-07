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



}


?>