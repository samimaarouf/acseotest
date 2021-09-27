<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     * @Ignore()
     */
    private $marked;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="question")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length="255")
     */
    private $content;

    public function __construct()
    {
        $this->marked = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }


    public function getContent(): ?String
    {
        return $this->content;
    }

    public function setContent(?String $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getMarked(): ?bool
    {
        return $this->marked;
    }

    public function setMarked(bool $marked): self
    {
        $this->marked = $marked;

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
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }
}
