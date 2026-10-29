<?php

namespace App\Entity;

use App\Repository\WeatherRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherRepository::class)]
class Weather
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $overcast = null;

    #[ORM\Column]
    private ?bool $cloudy = null;

    #[ORM\Column]
    private ?bool $sunny = null;

    #[ORM\Column]
    private ?bool $rainy = null;

    #[ORM\Column]
    private ?bool $snow = null;

    #[ORM\Column]
    private ?bool $foggy = null;

    #[ORM\Column]
    private ?bool $windy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isOvercast(): ?bool
    {
        return $this->overcast;
    }

    public function setOvercast(bool $overcast): static
    {
        $this->overcast = $overcast;

        return $this;
    }

    public function isCloudy(): ?bool
    {
        return $this->cloudy;
    }

    public function setCloudy(bool $cloudy): static
    {
        $this->cloudy = $cloudy;

        return $this;
    }

    public function isSunny(): ?bool
    {
        return $this->sunny;
    }

    public function setSunny(bool $sunny): static
    {
        $this->sunny = $sunny;

        return $this;
    }

    public function isRainy(): ?bool
    {
        return $this->rainy;
    }

    public function setRainy(bool $rainy): static
    {
        $this->rainy = $rainy;

        return $this;
    }

    public function isSnow(): ?bool
    {
        return $this->snow;
    }

    public function setSnow(bool $snow): static
    {
        $this->snow = $snow;

        return $this;
    }

    public function isFoggy(): ?bool
    {
        return $this->foggy;
    }

    public function setFoggy(bool $foggy): static
    {
        $this->foggy = $foggy;

        return $this;
    }

    public function isWindy(): ?bool
    {
        return $this->windy;
    }

    public function setWindy(bool $windy): static
    {
        $this->windy = $windy;

        return $this;
    }
}
