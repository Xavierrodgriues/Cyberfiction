<?php

namespace PHPMaker2024\project3\Entity;

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
use PHPMaker2024\project3\AbstractEntity;
use PHPMaker2024\project3\AdvancedSecurity;
use PHPMaker2024\project3\UserProfile;
use function PHPMaker2024\project3\Config;
use function PHPMaker2024\project3\EntityManager;
use function PHPMaker2024\project3\RemoveXss;
use function PHPMaker2024\project3\HtmlDecode;
use function PHPMaker2024\project3\EncryptPassword;

/**
 * Entity class for "view2" table
 */
#[Entity]
#[Table(name: "view2")]
class View2 extends AbstractEntity
{
    #[Column(type: "string")]
    private string $name;

    #[Column(type: "string")]
    private string $email;

    #[Column(type: "string")]
    private string $phonenum;

    #[Column(name: "is_verified", type: "integer")]
    private int $isVerified;

    #[Column(type: "integer")]
    private int $status;

    public function __construct()
    {
        $this->isVerified = 0;
        $this->status = 1;
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

    public function getPhonenum(): string
    {
        return HtmlDecode($this->phonenum);
    }

    public function setPhonenum(string $value): static
    {
        $this->phonenum = RemoveXss($value);
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
}
