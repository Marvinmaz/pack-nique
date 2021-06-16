<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *@ORM\Entity() 
 */
class User implements UserInterface{

    

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message ="le nom d'utilisateur ne doit pas etre vide")
     * @Assert\Length(
     *      min = 1,
     *      max = 30,
     *      minMessage = "Ce pseudo est trop court !",
     *      maxMessage = "Ce pseudo est trop long !"
     * )
     */
    private $username;



    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

     /**
     * @ORM\Column(type="string")
     * @Assert\Email(message ="votre mail n'est pas un mail valide !")
     * @Assert\NotBlank(message = "le champ email ne doit pas etre vide !")
     */ 
    private $mail; 
    
     /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message = "le mot de passe ne doit pas etre vide !")
     */
    private $password; 

     /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $address; 

     /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $postal_code;

     /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $first_name;

      /**
      * @ORM\Column(type="string", nullable=true)
      */
     private $name;

     /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age; 

     /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(
     *      min = 9,
     *      max = 19,
     *      minMessage = "le numero de telephone est trop court !",
     *      maxMessage = "le numero de telephone est trop long !",
     * ) 
     */
    private $tel; 

      /**
     * @ORM\Column(type="string", nullable=true)
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

    private $passwordHasher;


    public function __construct(UserPasswordHasher   $passwordHasher) {
        $this->solds = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->passwordHasher = $passwordHasher;
     
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
        $this->password = $this->passwordHasher->hashPassword($this, $password);

        return $this;
    }

   

    public function getPostalCode()
    {
        return $this->postal_code;
    }

    
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;

        return $this;
    }
 
    public function getFirstName()
    {
        return $this->first_name;
    }

    
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

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

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of roles
     */ 
    public function getRoles()
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        
        return array_unique($roles);
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */ 
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
         * @see UserInterface
         */
        public function getSalt()
        {
                // not needed when using the "bcrypt" algorithm in security.yaml
        }

        /**
         * @see UserInterface
         */
        public function eraseCredentials()
        {
                // If you store any temporary, sensitive data on the user, clear it here
                // $this->plainPassword = null;
        }

        public function getUserIdentifier()
        {
            return $this->username;
        }

        // /**
        //  * Get the value of name
        //  */ 
        // public function getName()
        // {
        //     return $this->name;
        // }

        // /**
        //  * Set the value of name
        //  *
        //  * @return  self
        //  */ 
        // public function setName($name)
        // {
        //     $this->name = $name;

        //     return $this;
        // }
}