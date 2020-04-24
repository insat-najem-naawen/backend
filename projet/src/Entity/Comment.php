<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\member", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\cv", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getAuthor(): ?member
    {
        return $this->author;
    }

    public function setAuthor(?member $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCv(): ?cv
    {
        return $this->cv;
    }

    public function setCv(?cv $cv): self
    {
        $this->cv = $cv;

        return $this;
    }
}
