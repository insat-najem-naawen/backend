<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 * @UniqueEntity(
 *     fields= {"username"},
 *     message= "username deja utilisé"
 * )
 */
class Member implements UserInterface
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *    message = "The email '{{ value }}' is not a valid email"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min="8", minMessage="Votre mot de passe doit contenir minimum 8 caractéres"
     * )
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Cv", mappedBy="owner", cascade={"persist", "remove"})
     */
    private $cv;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="author", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Opportunity", mappedBy="publishedBy")
     */
    private $opportunities;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->opportunities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function eraseCredentials(){}
    public function getSalt(){}
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getCv(): ?Cv
    {
        return $this->cv;
    }

    public function setCv(Cv $cv): self
    {
        $this->cv = $cv;

        // set the owning side of the relation if necessary
        if ($cv->getOwner() !== $this) {
            $cv->setOwner($this);
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Opportunity[]
     */
    public function getOpportunities(): Collection
    {
        return $this->opportunities;
    }

    public function addOpportunity(Opportunity $opportunity): self
    {
        if (!$this->opportunities->contains($opportunity)) {
            $this->opportunities[] = $opportunity;
            $opportunity->setPublishedBy($this);
        }

        return $this;
    }

    public function removeOpportunity(Opportunity $opportunity): self
    {
        if ($this->opportunities->contains($opportunity)) {
            $this->opportunities->removeElement($opportunity);
            // set the owning side to null (unless already changed)
            if ($opportunity->getPublishedBy() === $this) {
                $opportunity->setPublishedBy(null);
            }
        }

        return $this;
    }

}
