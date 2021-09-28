<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *@ORM\Entity() 
 */
class Comment {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message ="le contenu ne doit pas etre vide")
     * @Assert\Length(
     *      min = 1,
     *      max = 999,
     *      minMessage = "Le contenu est trop court !",
     *      maxMessage = "Le contenu est trop long !"
     * ) 
     */
    private $content;

    /**
     * @ORM\Column(name="created_at", type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(0)
     * @Assert\LessThanOrEqual(5)
     */
    private $note;

   
    // N : 1
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pack", inversedBy="comment")
     * @ORM\JoinColumn(name="pack_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $pack;

    // N : 1
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comment")
     */
    private $user;

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
     * Get the value of note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

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
     * Get the value of pack
     */ 
    public function getPack()
    {
        return $this->pack;
    }

    /**
     * Set the value of pack
     *
     * @return  self
     */ 
    public function setPack($pack)
    {
        $this->pack = $pack;

        return $this;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPackId(): ?int
    {
        return $this->pack_id;
    }

    public function setPackId(int $pack_id): self
    {
        $this->pack_id = $pack_id;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}