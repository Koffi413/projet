<?php

namespace App;

class search {

   /**
    *@var string
    */ 
    public $q ='';
    /**
     *  @var category[]
     */
    
    public $category = [];

    /**
     * @var null|integer 
     */
    public $max;

    /**
     * @var null|integer 
     */
    public $min;

    /**
     * @var boolean
     */
    public $promo = false;
}