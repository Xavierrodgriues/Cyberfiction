<?php

namespace PHPMaker2024\project4\Entity;

use DateTime;
use DateTimeImmutable;
use DateInterval;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\SequenceGenerator;
use Doctrine\DBAL\Types\Types;
use PHPMaker2024\project4\AbstractEntity;
use PHPMaker2024\project4\AdvancedSecurity;
use PHPMaker2024\project4\UserProfile;
use function PHPMaker2024\project4\Config;
use function PHPMaker2024\project4\EntityManager;
use function PHPMaker2024\project4\RemoveXss;
use function PHPMaker2024\project4\HtmlDecode;
use function PHPMaker2024\project4\EncryptPassword;

/**
 * Entity class for "view6" table
 */
#[Entity]
#[Table(name: "view6")]
class View6 extends AbstractEntity
{
    #[Column(type: "string")]
    private string $name;

    #[Column(type: "integer")]
    private int $area;

    #[Column(type: "integer")]
    private int $price;

    #[Column(type: "integer")]
    private int $quantity;

    #[Column(type: "integer")]
    private int $adult;

    #[Column(type: "integer")]
    private int $children;

    #[Column(type: "boolean")]
    private bool $status;

    #[Column(type: "integer")]
    private int $removed;

    public function __construct()
    {
        $this->status = true;
        $this->removed = 0;
    }

    public function getName(): string
    {
        return HtmlDecode($this->name);
    }

    public function setName(string $value): static
    {
        $this->name = RemoveXss($value);
        return $this;
    }

    public function getArea(): int
    {
        return $this->area;
    }

    public function setArea(int $value): static
    {
        $this->area = $value;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $value): static
    {
        $this->price = $value;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $value): static
    {
        $this->quantity = $value;
        return $this;
    }

    public function getAdult(): int
    {
        return $this->adult;
    }

    public function setAdult(int $value): static
    {
        $this->adult = $value;
        return $this;
    }

    public function getChildren(): int
    {
        return $this->children;
    }

    public function setChildren(int $value): static
    {
        $this->children = $value;
        return $this;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $value): static
    {
        $this->status = $value;
        return $this;
    }

    public function getRemoved(): int
    {
        return $this->removed;
    }

    public function setRemoved(int $value): static
    {
        $this->removed = $value;
        return $this;
    }
}
