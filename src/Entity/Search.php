<?php

namespace App\Entity;

class Search {

   /**
    *@var string
    */ 
    public $q ='';
    /**
     *  @var Categorie[]
     */
    
    public $Maisons = [];

    /**
     * @var boolean
     */
    public $promo = false;
    
    /**
     * @var null|integer 
     */
    public $max;

    /**
     * @var null|integer 
     */
    public $min;

    
}