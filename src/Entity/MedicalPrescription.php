<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class MedicalPrescription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $patientName = null;

    #[ORM\Column(type: "text")]
    private ?string $reasonForVisit = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $medicine = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $nextAppointment = null;

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

    public function getReasonForVisit(): ?string
    {
        return $this->reasonForVisit;
    }

    public function setReasonForVisit(string $reasonForVisit): self
    {
        $this->reasonForVisit = $reasonForVisit;
        return $this;
    }

    public function getMedicine(): ?string
    {
        return $this->medicine;
    }

    public function setMedicine(string $medicine): self
    {
        $this->medicine = $medicine;
        return $this;
    }

    public function getNextAppointment(): ?\DateTimeInterface
    {
        return $this->nextAppointment;
    }

    public function setNextAppointment(\DateTimeInterface $nextAppointment): self
    {
        $this->nextAppointment = $nextAppointment;
        return $this;
    }
}
