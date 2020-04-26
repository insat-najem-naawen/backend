<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OpportunityRepository")
 */
class Opportunity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    /**
     * @Assert\NotBlank
     */

    private $domain;

    /**
     * @ORM\Column(type="string", length=255)
     */
    /**
     * @Assert\NotBlank
     */
    /**
     * @Assert\Url
     */
    private $link;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    /**
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    /**
     * @Assert\Date
     * @var string A "Y-m-d" formatted value
     */
    private $publishedOn;

    /**
     * @ORM\Column(type="boolean")
     */
    private $approved = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\member", inversedBy="opportunities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $publishedBy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="opportunity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPublishedOn(): ?\DateTimeInterface
    {
        return $this->publishedOn;
    }

    public function setPublishedOn(\DateTimeInterface $publishedOn): self
    {
        $this->publishedOn = $publishedOn;

        return $this;
    }

    public function getApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): self
    {
        $this->approved = $approved;

        return $this;
    }

    public function getPublishedBy(): ?member
    {
        return $this->publishedBy;
    }

    public function setPublishedBy(?member $publishedBy): self
    {
        $this->publishedBy = $publishedBy;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
