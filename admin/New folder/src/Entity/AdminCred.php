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
 * Entity class for "admin_cred" table
 */
#[Entity]
#[Table(name: "admin_cred")]
class AdminCred extends AbstractEntity
{
    #[Id]
    #[Column(name: "sr_no", type: "integer", unique: true)]
    private int $srNo;

    #[Column(name: "admin_name", type: "string")]
    private string $adminName;

    #[Column(name: "admin_pass", type: "string")]
    private string $adminPass;

    public function getSrNo(): int
    {
        return $this->srNo;
    }

    public function setSrNo(int $value): static
    {
        $this->srNo = $value;
        return $this;
    }

    public function getAdminName(): string
    {
        return HtmlDecode($this->adminName);
    }

    public function setAdminName(string $value): static
    {
        $this->adminName = RemoveXss($value);
        return $this;
    }

    public function getAdminPass(): string
    {
        return HtmlDecode($this->adminPass);
    }

    public function setAdminPass(string $value): static
    {
        $this->adminPass = RemoveXss($value);
        return $this;
    }
}
