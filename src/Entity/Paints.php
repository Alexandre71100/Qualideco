<?php

namespace App\Entity;

use App\Repository\PaintsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PaintsRepository::class)]
#[Vich\Uploadable] 

class Paints
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'no', targetEntity: Category::class)]
    private $category;

    #[ORM\OneToMany(mappedBy: 'no', targetEntity: SubCategory::class)]
    private $subCategory;

    #[Assert\NotBlank(message:"Le titre de la peinture est obligatoire")]
    #[ORM\Column(type: 'string', length: 80)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $cover;

    #[Assert\NotBlank(message:"La destination de la peinture est obligatoire")]
    #[ORM\Column(type: 'string', length: 255)]
    private $destination;

    #[Assert\NotBlank(message:"Les caractéristique de la peinture sont obligatoire")]
    #[ORM\Column(type: 'string', length: 255)]
    private $features;

    #[Assert\NotBlank(message:"La description de la peinture est obligatoire")]
    #[ORM\Column(type: 'text')]
    private $description;

    #[Assert\NotBlank()]
    #[ORM\Column(type: 'integer')]
    private $price;

    #[Assert\NotBlank(message:"L'image est obligatoire'")]
    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'cover')]
    #[Assert\Image(mimeTypesMessage: 'Ce fichier n\'est pas une image')]
    #[Assert\File(maxSize: '1M', maxSizeMessage: 'Le fichier ne doit pas dépasser les {{ limit }} {{ suffix }}')]
    private $coverFile;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $updated_at;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->subCategory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
            $category->setNo($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getNo() === $this) {
                $category->setNo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, subCategory>
     */
    public function getSubCategory(): Collection
    {
        return $this->subCategory;
    }

    public function addSubCategory(SubCategory $subCategory): self
    {
        if (!$this->subCategory->contains($subCategory)) {
            $this->subCategory[] = $subCategory;
            $subCategory->setNo($this);
        }

        return $this;
    }

    public function removeSubCategory(subCategory $subCategory): self
    {
        if ($this->subCategory->removeElement($subCategory)) {
            // set the owning side to null (unless already changed)
            if ($subCategory->getNo() === $this) {
                $subCategory->setNo(null);
            }
        }

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

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getFeatures(): ?string
    {
        return $this->features;
    }

    public function setFeatures(string $features): self
    {
        $this->features = $features;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }


    public function getCoverFile(): ?File
    {
        return $this->coverFile;
    }

    public function setCoverFile(?File $coverFile = null): self
    {
        $this->coverFile = $coverFile;

        if ($coverFile !== null) {
            $this->updated_at = new DateTimeImmutable();
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
