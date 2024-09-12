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
 * Entity class for "booking records" table
 */
#[Entity]
#[Table(name: "`booking records`")]
class BookingRecord extends AbstractEntity
{
    #[Column(name: "sr_no", type: "integer")]
    private int $srNo;

    #[Column(name: "room_name", type: "string")]
    private string $roomName;

    #[Column(type: "integer")]
    private int $price;

    #[Column(name: "total_pay", type: "integer")]
    private int $totalPay;

    #[Column(name: "user_name", type: "string")]
    private string $userName;

    #[Column(type: "string")]
    private string $phonenum;

    #[Column(name: "check_in", type: "date")]
    private DateTime $checkIn;

    #[Column(name: "check_out", type: "date")]
    private DateTime $checkOut;

    #[Column(name: "booking_status", type: "string")]
    private string $bookingStatus;

    #[Column(name: "trans_amt", type: "integer")]
    private int $transAmt;

    #[Column(name: "trans_status", type: "string")]
    private string $transStatus;

    public function __construct()
    {
        $this->bookingStatus = "pending";
        $this->transStatus = "pending";
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

    public function getBookingStatus(): string
    {
        return HtmlDecode($this->bookingStatus);
    }

    public function setBookingStatus(string $value): static
    {
        $this->bookingStatus = RemoveXss($value);
        return $this;
    }

    public function getTransAmt(): int
    {
        return $this->transAmt;
    }

    public function setTransAmt(int $value): static
    {
        $this->transAmt = $value;
        return $this;
    }

    public function getTransStatus(): string
    {
        return HtmlDecode($this->transStatus);
    }

    public function setTransStatus(string $value): static
    {
        $this->transStatus = RemoveXss($value);
        return $this;
    }
}
