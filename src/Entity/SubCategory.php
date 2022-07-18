<?php

namespace App\Entity;

use App\Repository\SubCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SubCategoryRepository::class)]
class SubCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[Assert\NotBlank(message:"Le nom de la sous catégorie est obligatoire")]
    #[ORM\Column(type: 'string', length: 50)]

    private $name;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\OneToMany(mappedBy: 'subCategory', targetEntity: Paints::class)]
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
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
            $paint->setSubCategory($this);
        }

        return $this;
    }

    public function removePaint(Paints $paint): self
    {
        if ($this->paints->removeElement($paint)) {
            // set the owning side to null (unless already changed)
            if ($paint->getSubCategory() === $this) {
                $paint->setSubCategory(null);
            }
        }

        return $this;
    }

}
