<?php

namespace App\Entity;

use App\Repository\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntityRepository::class)]
class Entity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $race = null;

    #[ORM\Column(length: 255)]
    private ?string $class = null;

    #[ORM\Column(length: 1024)]
    private ?string $personnalGoals = null;

    #[ORM\Column(length: 1024)]
    private ?string $story = null;

    #[ORM\Column(length: 255)]
    private ?string $personality = null;

    #[ORM\Column(length: 255)]
    private ?string $advantages = null;

    #[ORM\Column(length: 255)]
    private ?string $penalty = null;

    #[ORM\Column]
    private ?int $hp = null;

    #[ORM\OneToMany(mappedBy: 'entity', targetEntity: Weapon::class)]
    private Collection $weapons;

    #[ORM\OneToMany(mappedBy: 'entity', targetEntity: Spell::class)]
    private Collection $spells;

    #[ORM\OneToMany(mappedBy: 'entity', targetEntity: Gear::class)]
    private Collection $gears;

    #[ORM\OneToOne(mappedBy: 'entity', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\Column]
    private ?int $strength = null;

    #[ORM\Column]
    private ?int $dexterity = null;

    #[ORM\Column]
    private ?int $constitution = null;

    #[ORM\Column]
    private ?int $intelligence = null;

    #[ORM\Column]
    private ?int $wisdom = null;

    #[ORM\Column]
    private ?int $charisma = null;

    #[ORM\Column(nullable: true)]
    private ?int $mana = null;

    #[ORM\ManyToMany(targetEntity: Event::class, mappedBy: 'entities')]
    private Collection $events;

    #[ORM\Column(length: 255)]
    private ?string $nickname = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Picture $picture = null;

    #[ORM\Column]
    private ?int $maxHp = null;


    public function __construct()
    {
        $this->weapons = new ArrayCollection();
        $this->spells = new ArrayCollection();
        $this->gears = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): static
    {
        $this->race = $race;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): static
    {
        $this->class = $class;

        return $this;
    }

    public function getPersonnalGoals(): ?string
    {
        return $this->personnalGoals;
    }

    public function setPersonnalGoals(string $personnalGoals): static
    {
        $this->personnalGoals = $personnalGoals;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(string $story): static
    {
        $this->story = $story;

        return $this;
    }

    public function getPersonality(): ?string
    {
        return $this->personality;
    }

    public function setPersonality(string $personality): static
    {
        $this->personality = $personality;

        return $this;
    }

    public function getAdvantages(): ?string
    {
        return $this->advantages;
    }

    public function setAdvantages(string $advantages): static
    {
        $this->advantages = $advantages;

        return $this;
    }

    public function getPenalty(): ?string
    {
        return $this->penalty;
    }

    public function setPenalty(string $penalty): static
    {
        $this->penalty = $penalty;

        return $this;
    }

    public function getItems(): ?string
    {
        return $this->items;
    }

    public function setItems(string $items): static
    {
        $this->items = $items;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): static
    {
        $this->hp = $hp;

        return $this;
    }

    /**
     * @return Collection<int, weapon>
     */
    public function getWeapons(): Collection
    {
        return $this->weapons;
    }

    public function addWeapon(weapon $weapon): static
    {
        if (!$this->weapons->contains($weapon)) {
            $this->weapons->add($weapon);
            $weapon->setEntity($this);
        }

        return $this;
    }

    public function removeWeapon(weapon $weapon): static
    {
        if ($this->weapons->removeElement($weapon)) {
            // set the owning side to null (unless already changed)
            if ($weapon->getEntity() === $this) {
                $weapon->setEntity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, spell>
     */
    public function getSpells(): Collection
    {
        return $this->spells;
    }

    public function addSpell(spell $spell): static
    {
        if (!$this->spells->contains($spell)) {
            $this->spells->add($spell);
            $spell->setEntity($this);
        }

        return $this;
    }

    public function removeSpell(spell $spell): static
    {
        if ($this->spells->removeElement($spell)) {
            // set the owning side to null (unless already changed)
            if ($spell->getEntity() === $this) {
                $spell->setEntity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, gear>
     */
    public function getGears(): Collection
    {
        return $this->gears;
    }

    public function addGear(gear $gear): static
    {
        if (!$this->gears->contains($gear)) {
            $this->gears->add($gear);
            $gear->setEntity($this);
        }

        return $this;
    }

    public function removeGear(gear $gear): static
    {
        if ($this->gears->removeElement($gear)) {
            // set the owning side to null (unless already changed)
            if ($gear->getEntity() === $this) {
                $gear->setEntity(null);
            }
        }

        return $this;
    }
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setEntity(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getEntity() !== $this) {
            $user->setEntity($this);
        }

        $this->user = $user;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): static
    {
        $this->strength = $strength;

        return $this;
    }

    public function getDexterity(): ?int
    {
        return $this->dexterity;
    }

    public function setDexterity(int $dexterity): static
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getConstitution(): ?int
    {
        return $this->constitution;
    }

    public function setConstitution(int $constitution): static
    {
        $this->constitution = $constitution;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): static
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getWisdom(): ?int
    {
        return $this->wisdom;
    }

    public function setWisdom(int $wisdom): static
    {
        $this->wisdom = $wisdom;

        return $this;
    }

    public function getCharisma(): ?int
    {
        return $this->charisma;
    }

    public function setCharisma(int $charisma): static
    {
        $this->charisma = $charisma;

        return $this;
    }

    public function getMana(): ?int
    {
        return $this->mana;
    }

    public function setMana(?int $mana): static
    {
        $this->mana = $mana;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->addEntity($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            $event->removeEntity($this);
        }

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): static
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getPicture(): ?picture
    {
        return $this->picture;
    }

    public function setPicture(?picture $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getMaxHp(): ?int
    {
        return $this->maxHp;
    }

    public function setMaxHp(int $maxHp): static
    {
        $this->maxHp = $maxHp;

        return $this;
    }
}
