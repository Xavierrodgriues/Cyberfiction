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
 * Entity class for "manager_cred" table
 */
#[Entity]
#[Table(name: "manager_cred")]
class ManagerCred extends AbstractEntity
{
    #[Column(name: "sr_no", type: "integer")]
    private int $srNo;

    #[Column(name: "manager_name", type: "string")]
    private string $managerName;

    #[Column(name: "manager_pass", type: "string")]
    private string $managerPass;

    public function getSrNo(): int
    {
        return $this->srNo;
    }

    public function setSrNo(int $value): static
    {
        $this->srNo = $value;
        return $this;
    }

    public function getManagerName(): string
    {
        return HtmlDecode($this->managerName);
    }

    public function setManagerName(string $value): static
    {
        $this->managerName = RemoveXss($value);
        return $this;
    }

    public function getManagerPass(): string
    {
        return HtmlDecode($this->managerPass);
    }

    public function setManagerPass(string $value): static
    {
        $this->managerPass = RemoveXss($value);
        return $this;
    }
}
