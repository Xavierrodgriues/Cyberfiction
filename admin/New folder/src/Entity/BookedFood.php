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
 * Entity class for "booked_food" table
 */
#[Entity]
#[Table(name: "booked_food")]
class BookedFood extends AbstractEntity
{
    #[Column(type: "integer")]
    private int $id;

    #[Column(name: "booking_id", type: "integer")]
    private int $bookingId;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "string")]
    private string $category;

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

    public function getCategory(): string
    {
        return HtmlDecode($this->category);
    }

    public function setCategory(string $value): static
    {
        $this->category = RemoveXss($value);
        return $this;
    }
}
