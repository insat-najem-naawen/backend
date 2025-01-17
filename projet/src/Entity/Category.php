<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\opportunity", mappedBy="category")
     */
    private $opportunity;

    public function __construct()
    {
        $this->opportunity = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|opportunity[]
     */
    public function getOpportunity(): Collection
    {
        return $this->opportunity;
    }

    public function addOpportunity(opportunity $opportunity): self
    {
        if (!$this->opportunity->contains($opportunity)) {
            $this->opportunity[] = $opportunity;
            $opportunity->setCategory($this);
        }

        return $this;
    }

    public function removeOpportunity(opportunity $opportunity): self
    {
        if ($this->opportunity->contains($opportunity)) {
            $this->opportunity->removeElement($opportunity);
            // set the owning side to null (unless already changed)
            if ($opportunity->getCategory() === $this) {
                $opportunity->setCategory(null);
            }
        }

        return $this;
    }
}
