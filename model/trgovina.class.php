<?php
    class Trgovina{

            protected $id,$name;

            function __construct($id,$name)
            {
                $this->id=$id;
                $this->name=$name;
                               
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