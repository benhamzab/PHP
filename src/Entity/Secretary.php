<?php

namespace App\Entity;

use App\Repository\SecretaryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecretaryRepository::class)]
class Secretary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $email;

    #[ORM\Column(type: 'string', length: 20)]
    private string $phoneNumber;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $assignedTasks = null;

    // Getter and Setter for ID
    public function getId(): ?int
    {
        return $this->id;
    }

    // Getter and Setter for Name
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    // Getter and Setter for Email
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    // Getter and Setter for Phone Number
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    // Getter and Setter for Assigned Tasks
    public function getAssignedTasks(): ?string
    {
        return $this->assignedTasks;
    }

    public function setAssignedTasks(?string $assignedTasks): self
    {
        $this->assignedTasks = $assignedTasks;
        return $this;
    }
}
