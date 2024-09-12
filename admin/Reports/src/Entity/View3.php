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
 * Entity class for "view3" table
 */
#[Entity]
#[Table(name: "view3")]
class View3 extends AbstractEntity
{
    #[Column(name: "booking_id", type: "integer")]
    private int $bookingId;

    #[Column(name: "user_name", type: "string")]
    private string $userName;

    #[Column(name: "room_name", type: "string")]
    private string $roomName;

    #[Column(type: "integer")]
    private int $price;

    #[Column(name: "total_pay", type: "integer")]
    private int $totalPay;

    #[Column(name: "check_in", type: "date")]
    private DateTime $checkIn;

    #[Column(name: "check_out", type: "date")]
    private DateTime $checkOut;

    #[Column(type: "integer", nullable: true)]
    private ?int $refund;

    #[Column(name: "booking_status", type: "string")]
    private string $bookingStatus;

    #[Column(name: "starter_name", type: "string")]
    private string $starterName;

    #[Column(name: "main_course_name", type: "string")]
    private string $mainCourseName;

    #[Column(name: "sweet_dish_name", type: "string")]
    private string $sweetDishName;

    #[Column(name: "trans_id", type: "string", nullable: true)]
    private ?string $transId;

    #[Column(name: "trans_amt", type: "integer")]
    private int $transAmt;

    #[Column(name: "trans_status", type: "string")]
    private string $transStatus;

    #[Column(type: "datetime")]
    private DateTime $datentime;

    #[Column(name: "rate_review", type: "integer", nullable: true)]
    private ?int $rateReview;

    #[Column(type: "string")]
    private string $phonenum;

    public function __construct()
    {
        $this->bookingStatus = "pending";
        $this->starterName = "None";
        $this->mainCourseName = "None";
        $this->sweetDishName = "None";
        $this->transStatus = "pending";
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

    public function getUserName(): string
    {
        return HtmlDecode($this->userName);
    }

    public function setUserName(string $value): static
    {
        $this->userName = RemoveXss($value);
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

    public function getStarterName(): string
    {
        return HtmlDecode($this->starterName);
    }

    public function setStarterName(string $value): static
    {
        $this->starterName = RemoveXss($value);
        return $this;
    }

    public function getMainCourseName(): string
    {
        return HtmlDecode($this->mainCourseName);
    }

    public function setMainCourseName(string $value): static
    {
        $this->mainCourseName = RemoveXss($value);
        return $this;
    }

    public function getSweetDishName(): string
    {
        return HtmlDecode($this->sweetDishName);
    }

    public function setSweetDishName(string $value): static
    {
        $this->sweetDishName = RemoveXss($value);
        return $this;
    }

    public function getTransId(): ?string
    {
        return HtmlDecode($this->transId);
    }

    public function setTransId(?string $value): static
    {
        $this->transId = RemoveXss($value);
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

    public function getDatentime(): DateTime
    {
        return $this->datentime;
    }

    public function setDatentime(DateTime $value): static
    {
        $this->datentime = $value;
        return $this;
    }

    public function getRateReview(): ?int
    {
        return $this->rateReview;
    }

    public function setRateReview(?int $value): static
    {
        $this->rateReview = $value;
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
}
