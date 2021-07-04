<?php
require_once __DIR__.'/../model/specerajservice.class.php';
class IndexController{

    public function index()
    {

        $productList=SpecerajService::getProductsOnAkcija();
        require_once __DIR__.'/../view/products_index.php';
    }
    
}

?>