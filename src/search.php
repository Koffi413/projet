<?php

namespace App;

class search {

   /**
    *@var string
    */ 
    public $q ='';
    /**
     *  @var Categorie[]
     */
    
    public $categorie = [];

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