<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    collectionOperations: ['get',
                            'post' =>['security' => 'is_granted("ROLE_ADMIN")']
],
    itemOperations: [
        'get'=> [
            'path' => '/products/{id}',
            'requirements' => ['id' => '\d+'],
            'normalization_context' => ['groups' => ['read:collection']]
        ],
    ],

    normalizationContext: ['groups' => ['read:collection']]

)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Groups(['read:collection'])]
    private ?string $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Groups(['read:collection'])]
    private ?string $description;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Groups(['read:collection'])]
    private ?int $price;

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
}
