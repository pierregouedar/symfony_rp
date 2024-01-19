<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BLOB)]
    private $picture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture()
    {
        return 'data:image/png;base64,'.base64_encode(stream_get_contents($this->picture));
    }

    public function setPicture($picture): static
    {
        $this->picture = $picture;

        return $this;
    }
}
