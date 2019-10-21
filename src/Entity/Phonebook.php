<?php

namespace App\Entity;

use App\Validator\PhoneNumberExist;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhonebookRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Phonebook
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     * @ORM\Column(type="string", length=50)
     */
    private $firstName;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     * @ORM\Column(type="string", length=50)
     */
    private $lastName;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=6)
     * @Assert\Regex(
     *     pattern="/^(\+44|0)\d{10}$/",
     *     message="Please enter a valid phone number (starting with 0 or +44)."
     * )
     * @PhoneNumberExist
     * @ORM\Column(type="string", length=30)
     */
    private $phone;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function onCreate(): void
    {
        $this->createdAt = new \DateTime();
        $this->updateAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function onUpdate(): void
    {
        $this->updateAt = new \DateTime();
    }
}
