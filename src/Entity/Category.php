<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Stringable;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category implements Stringable

{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[Assert\NotBlank(message:"Le nom de la catégorie est obligatoire")]
    #[ORM\Column(type: 'string', length: 50)]

    private $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Paints::class)]
    private $paints;

    public function __construct()
    {
        $this->paints = new ArrayCollection();
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

    public function __toString(): string
    {
        return $this->name;       
    }

    /**
     * @return Collection<int, Paints>
     */
    public function getPaints(): Collection
    {
        return $this->paints;
    }

    public function addPaint(Paints $paint): self
    {
        if (!$this->paints->contains($paint)) {
            $this->paints[] = $paint;
            $paint->setCategory($this);
        }

        return $this;
    }

    public function removePaint(Paints $paint): self
    {
        if ($this->paints->removeElement($paint)) {
            // set the owning side to null (unless already changed)
            if ($paint->getCategory() === $this) {
                $paint->setCategory(null);
            }
        }

        return $this;
    }

}
