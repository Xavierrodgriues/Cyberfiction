<?php

namespace PHPMaker2024\project1\Entity;

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
use PHPMaker2024\project1\AbstractEntity;
use PHPMaker2024\project1\AdvancedSecurity;
use PHPMaker2024\project1\UserProfile;
use function PHPMaker2024\project1\Config;
use function PHPMaker2024\project1\EntityManager;
use function PHPMaker2024\project1\RemoveXss;
use function PHPMaker2024\project1\HtmlDecode;
use function PHPMaker2024\project1\EncryptPassword;

/**
 * Entity class for "view1" table
 */
#[Entity]
#[Table(name: "view1")]
class View1 extends AbstractEntity
{
    #[Column(type: "integer")]
    private int $id;

    #[Column(name: "booking_id", type: "integer")]
    private int $bookingId;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "integer")]
    private int $area;

    #[Column(type: "integer")]
    private int $price;

    #[Column(name: "trans_amt", type: "integer")]
    private int $transAmt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getBookingId(): int
    {
        return $this->bookingId;
    }

    public function setBookingId(int $value): static
    {
        $this->bookingId = $value;
        return $this;
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

    public function getTransAmt(): int
    {
        return $this->transAmt;
    }

    public function setTransAmt(int $value): static
    {
        $this->transAmt = $value;
        return $this;
    }
}
