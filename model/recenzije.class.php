<?php
    class Recenzija{

            protected $id,$id_trgovina,$id_user, $ocjena, $komentar;

            function __construct($id,$id_trgovina,$id_user, $ocjena, $komentar)
            {
                $this->id=$id;
                $this->id_trgovina=$id_trgovina;
                $this->id_user=$id_user;
                $this->ocjena=$ocjena;
                $this->komentar=$komentar;                
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