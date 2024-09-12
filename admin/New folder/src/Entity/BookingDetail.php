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
 * Entity class for "booking_details" table
 */
#[Entity]
#[Table(name: "booking_details")]
class BookingDetail extends AbstractEntity
{
    #[Column(name: "sr_no", type: "integer")]
    private int $srNo;

    #[Column(name: "booking_id", type: "integer")]
    private int $bookingId;

    #[Column(name: "room_name", type: "string")]
    private string $roomName;

    #[Column(type: "integer")]
    private int $price;

    #[Column(name: "total_pay", type: "integer")]
    private int $totalPay;

    #[Column(name: "room_no", type: "string", nullable: true)]
    private ?string $roomNo;

    #[Column(name: "user_name", type: "string")]
    private string $userName;

    #[Column(type: "string")]
    private string $phonenum;

    #[Column(type: "string")]
    private string $address;

    public function getSrNo(): int
    {
        return $this->srNo;
    }

    public function setSrNo(int $value): static
    {
        $this->srNo = $value;
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

    public function getRoomName(): string
    {
        return HtmlDecode($this->roomName);
    }

    public function setRoomName(string $value): static
    {
        $this->roomName = RemoveXss($value);
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

    public function getTotalPay(): int
    {
        return $this->totalPay;
    }

    public function setTotalPay(int $value): static
    {
        $this->totalPay = $value;
        return $this;
    }

    public function getRoomNo(): ?string
    {
        return HtmlDecode($this->roomNo);
    }

    public function setRoomNo(?string $value): static
    {
        $this->roomNo = RemoveXss($value);
        return $this;
    }

    public function getUserName(): string
    {
        return HtmlDecode($this->userName);
    }

    public function setUserName(string $value): static
    {
        $this->userName = RemoveXss($value);
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

    public function getAddress(): string
    {
        return HtmlDecode($this->address);
    }

    public function setAddress(string $value): static
    {
        $this->address = RemoveXss($value);
        return $this;
    }
}
