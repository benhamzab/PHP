<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $patientName = null;

    #[ORM\Column(type: 'integer')]
    private ?int $age = null;

    #[ORM\Column(type: 'text')]
    private ?string $reasonOfVisit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatientName(): ?string
    {
        return $this->patientName;
    }

    public function setPatientName(string $patientName): self
    {
        $this->patientName = $patientName;
        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;
        return $this;
    }

    public function getReasonOfVisit(): ?string
    {
        return $this->reasonOfVisit;
    }

    public function setReasonOfVisit(string $reasonOfVisit): self
    {
        $this->reasonOfVisit = $reasonOfVisit;
        return $this;
    }
}
