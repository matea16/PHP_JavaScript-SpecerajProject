<?php
    class Product{

            protected $id,$id_trgovina,$name, $akcija, $price;

            function __construct($id,$id_trgovina,$name, $akcija, $price)
            {
                $this->id=$id;
                $this->id_trgovina=$id_trgovina;
                $this->name=$name;
                $this->akcija=$akcija;
                $this->price=$price;                
            }

            function __get($property)
            {
                if( property_exists( $this, $property ) )
                 return $this->$property;
            }

            function __set($property, $value)
            {
                if( property_exists( $this, $property) )
                 $this->$property = $value;
                
                return $this;                
            }
    };

?>