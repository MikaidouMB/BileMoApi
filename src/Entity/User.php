<?php

namespace App\Entity;

use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    collectionOperations:['get','post'],
    itemOperations: [
        "get" => [ "security" => 'object.getCustomer() == user'],
        "delete" => ['method' => 'delete']
    ],
)
]
class User implements UserOwnedInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * First name of a user.
     *
     */
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private ?string $firstname;

    /**
     * Last name of a user
     */
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private ?string $lastname;

    /**
     * Customer linked to user
     */
    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'user')]
    private $customer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;
        return $this;
    }
}
