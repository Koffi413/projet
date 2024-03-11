<?php

namespace App\Entity;
class Search {
    
    /**
     * @var int|null
     */
    private $min;
    /**
     * @var int|null
     */
    private $max;

    /**
     * @var categorie[]
     */
    public $categorie = [];
     

    /**
     * Get the value of min
     *
     * @return  int|null
     */ 
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Set the value of min
     *
     * @param  int|null  $min
     *
     * @return  self
     */ 
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get the value of max
     *
     * @return  int|null
     */ 
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Set the value of max
     *
     * @param  int|null  $max
     *
     * @return  self
     */ 
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }


    /**
     * Get the value of categorie
     *
     * @return  categorie[]
     */ 
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set the value of categorie
     *
     * @param  categorie[]  $categorie
     *
     * @return  self
     */ 
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }
}