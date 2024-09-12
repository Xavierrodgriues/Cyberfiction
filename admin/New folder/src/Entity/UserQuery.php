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
 * Entity class for "user_queries" table
 */
#[Entity]
#[Table(name: "user_queries")]
class UserQuery extends AbstractEntity
{
    #[Column(name: "sr_no", type: "integer")]
    private int $srNo;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "string")]
    private string $email;

    #[Column(type: "string")]
    private string $subject;

    #[Column(type: "string")]
    private string $message;

    #[Column(type: "datetime")]
    private DateTime $datentime;

    #[Column(type: "boolean")]
    private bool $seen;

    public function __construct()
    {
        $this->seen = false;
    }

    public function getSrNo(): int
    {
        return $this->srNo;
    }

    public function setSrNo(int $value): static
    {
        $this->srNo = $value;
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

    public function getSubject(): string
    {
        return HtmlDecode($this->subject);
    }

    public function setSubject(string $value): static
    {
        $this->subject = RemoveXss($value);
        return $this;
    }

    public function getMessage(): string
    {
        return HtmlDecode($this->message);
    }

    public function setMessage(string $value): static
    {
        $this->message = RemoveXss($value);
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

    public function getSeen(): bool
    {
        return $this->seen;
    }

    public function setSeen(bool $value): static
    {
        $this->seen = $value;
        return $this;
    }
}
