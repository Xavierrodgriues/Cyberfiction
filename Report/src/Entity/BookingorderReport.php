<?php

namespace PHPMaker2024\project2\Entity;

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
use PHPMaker2024\project2\AbstractEntity;
use PHPMaker2024\project2\AdvancedSecurity;
use PHPMaker2024\project2\UserProfile;
use function PHPMaker2024\project2\Config;
use function PHPMaker2024\project2\EntityManager;
use function PHPMaker2024\project2\RemoveXss;
use function PHPMaker2024\project2\HtmlDecode;
use function PHPMaker2024\project2\EncryptPassword;

/**
 * Entity class for "bookingorder report" table
 */
#[Entity]
#[Table(name: "`bookingorder report`")]
class BookingorderReport extends AbstractEntity
{
    #[Column(name: "booking_id", type: "integer")]
    private int $bookingId;

    #[Column(name: "check_in", type: "date")]
    private DateTime $checkIn;

    #[Column(name: "check_out", type: "date")]
    private DateTime $checkOut;

    #[Column(type: "integer", nullable: true)]
    private ?int $refund;

    #[Column(name: "booking_status", type: "string")]
    private string $bookingStatus;

    #[Column(name: "trans_resp_mesg", type: "string", nullable: true)]
    private ?string $transRespMesg;

    #[Column(type: "datetime")]
    private DateTime $datentime;

    #[Column(type: "string")]
    private string $name;

    #[Column(type: "string")]
    private string $name1;

    #[Column(type: "integer")]
    private int $price;

    #[Column(type: "boolean")]
    private bool $status;

    #[Column(name: "is_verified", type: "integer")]
    private int $isVerified;

    public function __construct()
    {
        $this->bookingStatus = "pending";
        $this->status = true;
        $this->isVerified = 0;
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

    public function getCheckIn(): DateTime
    {
        return $this->checkIn;
    }

    public function setCheckIn(DateTime $value): static
    {
        $this->checkIn = $value;
        return $this;
    }

    public function getCheckOut(): DateTime
    {
        return $this->checkOut;
    }

    public function setCheckOut(DateTime $value): static
    {
        $this->checkOut = $value;
        return $this;
    }

    public function getRefund(): ?int
    {
        return $this->refund;
    }

    public function setRefund(?int $value): static
    {
        $this->refund = $value;
        return $this;
    }

    public function getBookingStatus(): string
    {
        return HtmlDecode($this->bookingStatus);
    }

    public function setBookingStatus(string $value): static
    {
        $this->bookingStatus = RemoveXss($value);
        return $this;
    }

    public function getTransRespMesg(): ?string
    {
        return HtmlDecode($this->transRespMesg);
    }

    public function setTransRespMesg(?string $value): static
    {
        $this->transRespMesg = RemoveXss($value);
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

    public function getName(): string
    {
        return HtmlDecode($this->name);
    }

    public function setName(string $value): static
    {
        $this->name = RemoveXss($value);
        return $this;
    }

    public function getName1(): string
    {
        return HtmlDecode($this->name1);
    }

    public function setName1(string $value): static
    {
        $this->name1 = RemoveXss($value);
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

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $value): static
    {
        $this->status = $value;
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
}
