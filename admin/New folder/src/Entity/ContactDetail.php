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
 * Entity class for "contact_details" table
 */
#[Entity]
#[Table(name: "contact_details")]
class ContactDetail extends AbstractEntity
{
    #[Column(name: "sr_no", type: "integer")]
    private int $srNo;

    #[Column(type: "string")]
    private string $address;

    #[Column(type: "string")]
    private string $gmap;

    #[Column(type: "bigint")]
    private string $pn1;

    #[Column(type: "bigint")]
    private string $pn2;

    #[Column(type: "string")]
    private string $email;

    #[Column(type: "string")]
    private string $fb;

    #[Column(type: "string")]
    private string $insta;

    #[Column(type: "string")]
    private string $tw;

    #[Column(type: "string")]
    private string $iframe;

    public function getSrNo(): int
    {
        return $this->srNo;
    }

    public function setSrNo(int $value): static
    {
        $this->srNo = $value;
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

    public function getGmap(): string
    {
        return HtmlDecode($this->gmap);
    }

    public function setGmap(string $value): static
    {
        $this->gmap = RemoveXss($value);
        return $this;
    }

    public function getPn1(): string
    {
        return $this->pn1;
    }

    public function setPn1(string $value): static
    {
        $this->pn1 = $value;
        return $this;
    }

    public function getPn2(): string
    {
        return $this->pn2;
    }

    public function setPn2(string $value): static
    {
        $this->pn2 = $value;
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

    public function getFb(): string
    {
        return HtmlDecode($this->fb);
    }

    public function setFb(string $value): static
    {
        $this->fb = RemoveXss($value);
        return $this;
    }

    public function getInsta(): string
    {
        return HtmlDecode($this->insta);
    }

    public function setInsta(string $value): static
    {
        $this->insta = RemoveXss($value);
        return $this;
    }

    public function getTw(): string
    {
        return HtmlDecode($this->tw);
    }

    public function setTw(string $value): static
    {
        $this->tw = RemoveXss($value);
        return $this;
    }

    public function getIframe(): string
    {
        return HtmlDecode($this->iframe);
    }

    public function setIframe(string $value): static
    {
        $this->iframe = RemoveXss($value);
        return $this;
    }
}
