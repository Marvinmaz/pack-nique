<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *@ORM\Entity() 
 */
class Pack {


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message ="le nom ne doit pas etre vide")
     * @Assert\length(
     *      min = 1,
     *      minMessage = "le nom est trop court !"
     * ) 
     */ 
    private $name;

    /**
     * @ORM\Column(type="string")
     */ 
    private $picture;

    /**
     * @ORM\Column(type="float")
     */ 
    private $price;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message ="le contenu ne doit pas etre vide")
     * @Assert\length(
     *      min = 1,
     *      minMessage = "le contenu est trop court !"
     * ) 
     */ 
    private $content; 

    /**
     * @ORM\Column(type="array")
     */ 
    private $categories; 
    const STANDARD_CATEGORIES = ['vegan', 'végétarien', 'halal', 'anniversaire', 'réunion', 'pique-nique', 'duo', 'romantique', 'soirée', 'bbq'];


    /**
     * @ORM\Column(type="integer")
     */ 
    private $sales_volume;


    // 0:n
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="Pack")
     */
    private $comment;

    // 1:1
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Basket")
     */
    private $basket; 

    public function __construct() {
        $this->comment = new ArrayCollection();
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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;

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
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of categories
     */ 
    public function getCategories()
    {
        return $this->categories;
    }

    
    /**
     * Set the value of categories
     *
     * @return  self
     */ 
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get the value of sales_volume
     */ 
    public function getSales_volume()
    {
        return $this->sales_volume;
    }

    /**
     * Set the value of sales_volume
     *
     * @return  self
     */ 
    public function setSales_volume($sales_volume)
    {
        $this->sales_volume = $sales_volume;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

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
}