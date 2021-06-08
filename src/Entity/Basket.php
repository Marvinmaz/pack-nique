<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *@ORM\Entity() 
 */
class Basket { 

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="float")
     */
    private $price;

    // 0:n
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pack", mappedBy="basket")
     */
    private $packs;

    // 1:1
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Sold")
     */
    private $sold; 


    public function __construct() {
        $this->packs = new ArrayCollection();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of pack
     */ 
    public function getPacks()
    {
        return $this->packs;
    }

    /**
     * Set the value of pack
     *
     * @return  self
     */ 
    public function setPacks($packs)
    {
        $this->packs = $packs;

        return $this;
    }

    /**
     * Get the value of sold
     */ 
    public function getSold()
    {
        return $this->sold;
    }

    /**
     * Set the value of sold
     *
     * @return  self
     */ 
    public function setSold($sold)
    {
        $this->sold = $sold;

        return $this;
    }
}