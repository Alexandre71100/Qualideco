<?php

namespace App\Entity;

use App\Repository\PaintsRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Category;

#[ORM\Entity(repositoryClass: PaintsRepository::class)]
#[Vich\Uploadable] 

class Paints
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Assert\NotBlank(message:"Le titre de la peinture est obligatoire")]
    #[ORM\Column(type: 'string', length: 80)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    #[ORM\JoinColumn(nullable: true)]
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

    #[Assert\NotBlank(message:"Le prix de la peinture est obligatoire")]
    #[ORM\Column(type: 'integer')]
    private $price;

    
    // #[Assert\NotBlank(message:"L'image est obligatoire'")]
    #[ORM\JoinColumn(nullable: true)]
    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'cover')]
    #[Assert\Image(mimeTypesMessage: 'Ce fichier n\'est pas une image')]
    #[Assert\File(maxSize: '1M', maxSizeMessage: 'Le fichier ne doit pas dépasser les {{ limit }} {{ suffix }}')]
    private $coverFile;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $updated_at;

    #[Assert\NotBlank(message:"La catégorie de la peinture est obligatoire")]
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'paints')]
    #[ORM\JoinColumn(nullable: true)]
    private $category;

    #[ORM\ManyToOne(targetEntity: SubCategory::class, inversedBy: 'paints')]
    #[ORM\JoinColumn(nullable: true)]
    private $subCategory;

    public function getId(): ?int
    {
        return $this->id;
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

    public function setCover(?string $cover): self
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

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    public function getSubCategory(): ?SubCategory
    {
        return $this->subCategory;
    }

    public function setSubCategory(?SubCategory $subCategory): self
    {
        $this->subCategory = $subCategory;

        return $this;
    }
}
