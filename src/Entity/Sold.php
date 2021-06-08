<?php

namespace App\Entity;

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

    /**
     * @ORM\Column(type="string")
     */ 
    private $code;

     /**
     * @ORM\Column(type="boolean")
     */ 
    private $inProgress;

    // 1:1
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     */
    private $user;

    // 1:1
    /**
    * @ORM\OneToOne(targetEntity="App\Entity\Basket")
    */
    private $basket;




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
     * Get the value of basket
     */ 
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * Set the value of basket
     *
     * @return  self
     */ 
    public function setBasket($basket)
    {
        $this->basket = $basket;

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
}