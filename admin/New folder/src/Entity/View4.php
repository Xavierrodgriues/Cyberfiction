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
 * Entity class for "view4" table
 */
#[Entity]
#[Table(name: "view4")]
class View4 extends AbstractEntity
{
    #[Column(type: "integer")]
    private int $id;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "string")]
    private string $email;

    #[Column(type: "string")]
    private string $address;

    #[Column(type: "string")]
    private string $phonenum;

    #[Column(type: "integer")]
    private int $pincode;

    #[Column(type: "date")]
    private DateTime $dob;

    #[Column(name: "is_verified", type: "integer")]
    private int $isVerified;

    #[Column(type: "integer")]
    private int $status;

    #[Column(type: "datetime")]
    private DateTime $datentime;

    public function __construct()
    {
        $this->isVerified = 0;
        $this->status = 1;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
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

    public function getEmail(): string
    {
        return HtmlDecode($this->email);
    }

    public function setEmail(string $value): static
    {
        $this->email = RemoveXss($value);
        return $this;
    }

    public function getAddress(): string
    {
        return HtmlDecode($this->address);
    }

    public function setAddress(string $value): static
    {
        $this->address = RemoveXss($value);
        return $this;
    }

    public function getPhonenum(): string
    {
        return HtmlDecode($this->phonenum);
    }

    public function setPhonenum(string $value): static
    {
        $this->phonenum = RemoveXss($value);
        return $this;
    }

    public function getPincode(): int
    {
        return $this->pincode;
    }

    public function setPincode(int $value): static
    {
        $this->pincode = $value;
        return $this;
    }

    public function getDob(): DateTime
    {
        return $this->dob;
    }

    public function setDob(DateTime $value): static
    {
        $this->dob = $value;
        return $this;
    }

    public function getIsVerified(): int
    {
        return $this->isVerified;
    }

    public function setIsVerified(int $value): static
    {
        $this->isVerified = $value;
        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $value): static
    {
        $this->status = $value;
        return $this;
    }

    public function getDatentime(): DateTime
    {
        return $this->datentime;
    }

    public function setDatentime(DateTime $value): static
    {
        $this->datentime = $value;
        return $this;
    }
}
