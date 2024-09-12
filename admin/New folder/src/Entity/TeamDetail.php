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
 * Entity class for "team_details" table
 */
#[Entity]
#[Table(name: "team_details")]
class TeamDetail extends AbstractEntity
{
    #[Column(name: "sr_no", type: "integer")]
    private int $srNo;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "string")]
    private string $picture;

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

    public function getPicture(): string
    {
        return HtmlDecode($this->picture);
    }

    public function setPicture(string $value): static
    {
        $this->picture = RemoveXss($value);
        return $this;
    }
}
