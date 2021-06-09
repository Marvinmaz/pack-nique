<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *@ORM\Entity() 
 */
class User {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @Assert\NotBlank(message ="un nom ne doit pas etre vide")
     * @Assert\length(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Ce nom est trop court !",
     *      maxMessage = "Ce nom est trop long !"
     * )
     * @ORM\Column(type="string")
     */
    private $name;

     /**
     * @ORM\Column(type="string")
     * @Assert\Email(message ="votre '{{mail}}' n'est pas un mail valide !")
     * @Assert\NotBlank(message = "le champ email ne doit pas etre vide !")
     */ 
    private $mail; 
    
     /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message = "le mot de passe ne doit pas etre vide !")
     */
    private $password; 

     /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message = "le champ adresse ne doit pas etre vide ")
     */
    private $address; 

     /**
     * @ORM\Column(type="string")
     *  @Assert\NotBlank(message = "le code postale ne doit pas etre vide ")
     */
    private $postalCode;

     /**
     * @ORM\Column(type="string")
     *  @Assert\NotBlank(message ="un nom ne doit pas etre vide")
     *  @Assert\length(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Ce nom est trop court !",
     *      maxMessage = "Ce nom est trop long !"
     * ) 
     */
    private $firstName;

     /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message ="un nom ne doit pas etre vide")
     * @Assert\Range(
     *      min = 18,
     *      max = 120,
     *      notInRangeMessage = "Vous devez avoir entre {{ min }} et {{ max }} ans ",
     * ) 
     */
    private $age; 

     /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message ="le numero de telphone ne doit pas etre vide")
     * @Assert\length(
     *      min = 9,
     *      max = 19,
     *      minMessage = "le numero de telephone est trop court !",
     *      maxMessage = "le numero de telephone est trop long !",
     * ) 
     */
    private $tel;

     /**
     * @ORM\Column(type="string")
     */
    private $pics; 

      /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message ="le champ ville ne doit pas etre vide"),
     */
    private $country;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    // 0 : N
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sold", mappedBy="User")
     */
    private $solds;

    // 0 : N
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="User")
     */
    private $comments;

    public function __construct() {
        $this->solds = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }
     
    public function getId()
    {
        return $this->id;
    }

   
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    
    public function getMail()
    {
        return $this->mail;
    }

    
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

  
    public function getPassword()
    {
        return $this->password;
    }

    
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

   

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }
 
    public function getFirstName()
    {
        return $this->firstName;
    }

    
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getAge()
    {
        return $this->age;
    }

    
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    
    public function getTel()
    {
        return $this->tel;
    }


    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    public function getPics()
    {
        return $this->pics;
    }

  
    public function setPics($pics)
    {
        $this->pics = $pics;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of sold
     */ 
    public function getSolds()
    {
        return $this->solds;
    }

    /**
     * Set the value of sold
     *
     * @return  self
     */ 
    public function setSolds($solds)
    {
        $this->solds = $solds;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get the value of historic
     */ 
    public function getHistoric()
    {
        return $this->historic;
    }

    /**
     * Set the value of historic
     *
     * @return  self
     */ 
    public function setHistoric($historic)
    {
        $this->historic = $historic;

        return $this;
    }

    /**
     * Get the value of isAdmin
     */ 
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of isAdmin
     *
     * @return  self
     */ 
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
}