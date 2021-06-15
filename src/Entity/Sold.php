<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *@ORM\Entity() 
 */
class Sold {
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\Column(type="string")
     */ 
    private $price;

    /**
     * @ORM\Column(name="created_at", type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */ 
    private $createdAt;


    private $code;

     /**
     * @ORM\Column(type="boolean")
     */ 
    private $inProgress;

    // N : 0
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="solds")
     */
    private $user;

    // 0 : N
    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Pack", mappedBy="sold")
    */
    private $packs;

    public function __construct() {
        $this->packs = new ArrayCollection();
    }

    /**
     * Get the value of date
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

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
     * Get the value of inProgress
     */ 
    public function getInProgress()
    {
        return $this->inProgress;
    }

    /**
     * Set the value of inProgress
     *
     * @return  self
     */ 
    public function setInProgress($inProgress)
    {
        $this->inProgress = $inProgress;

        return $this;
    }

    /**
     * Get the value of packs
     */ 
    public function getPacks()
    {
        return $this->packs;
    }

    /**
     * Set the value of packs
     *
     * @return  self
     */ 
    public function setPacks($packs)
    {
        $this->packs = $packs;

        return $this;
    }
}