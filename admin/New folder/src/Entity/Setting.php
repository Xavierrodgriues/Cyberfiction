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
 * Entity class for "settings" table
 */
#[Entity]
#[Table(name: "settings")]
class Setting extends AbstractEntity
{
    #[Column(name: "sr_no", type: "integer")]
    private int $srNo;

    #[Column(name: "site_title", type: "string")]
    private string $siteTitle;

    #[Column(name: "site_about", type: "string")]
    private string $siteAbout;

    #[Column(type: "boolean")]
    private bool $shutdown;

    public function getSrNo(): int
    {
        return $this->srNo;
    }

    public function setSrNo(int $value): static
    {
        $this->srNo = $value;
        return $this;
    }

    public function getSiteTitle(): string
    {
        return HtmlDecode($this->siteTitle);
    }

    public function setSiteTitle(string $value): static
    {
        $this->siteTitle = RemoveXss($value);
        return $this;
    }

    public function getSiteAbout(): string
    {
        return HtmlDecode($this->siteAbout);
    }

    public function setSiteAbout(string $value): static
    {
        $this->siteAbout = RemoveXss($value);
        return $this;
    }

    public function getShutdown(): bool
    {
        return $this->shutdown;
    }

    public function setShutdown(bool $value): static
    {
        $this->shutdown = $value;
        return $this;
    }
}
