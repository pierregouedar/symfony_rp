<?php

namespace App\Entity;

use App\Repository\SpellRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpellRepository::class)]
class Spell
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $damageType = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $damage = null;

    #[ORM\Column]
    private ?float $spellRange = null;

    #[ORM\Column]
    private ?int $manaAmount = null;

    #[ORM\ManyToOne(inversedBy: 'spells')]
    private ?Entity $entity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDamageType(): ?string
    {
        return $this->damageType;
    }

    public function setDamageType(string $damageType): static
    {
        $this->damageType = $damageType;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDamage(): ?int
    {
        return $this->damage;
    }

    public function setDamage(int $damage): static
    {
        $this->damage = $damage;

        return $this;
    }

    public function getSpellRange(): ?float
    {
        return $this->spellRange;
    }

    public function setSpellRange(float $spellRange): static
    {
        $this->spellRange = $spellRange;

        return $this;
    }

    public function getManaAmount(): ?int
    {
        return $this->manaAmount;
    }

    public function setManaAmount(int $manaAmount): static
    {
        $this->manaAmount = $manaAmount;

        return $this;
    }

    public function getEntity(): ?Entity
    {
        return $this->entity;
    }

    public function setEntity(?Entity $entity): static
    {
        $this->entity = $entity;

        return $this;
    }
}
