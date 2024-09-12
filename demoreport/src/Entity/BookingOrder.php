<?php

namespace PHPMaker2024\project1\Entity;

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
use PHPMaker2024\project1\AbstractEntity;
use PHPMaker2024\project1\AdvancedSecurity;
use PHPMaker2024\project1\UserProfile;
use function PHPMaker2024\project1\Config;
use function PHPMaker2024\project1\EntityManager;
use function PHPMaker2024\project1\RemoveXss;
use function PHPMaker2024\project1\HtmlDecode;
use function PHPMaker2024\project1\EncryptPassword;

/**
 * Entity class for "booking_order" table
 */
#[Entity]
#[Table(name: "booking_order")]
class BookingOrder extends AbstractEntity
{
    #[Column(name: "booking_id", type: "integer")]
    private int $bookingId;

    #[Column(name: "user_id", type: "integer")]
    private int $userId;

    #[Column(name: "room_id", type: "integer")]
    private int $roomId;

    #[Column(name: "check_in", type: "date")]
    private DateTime $checkIn;

    #[Column(name: "check_out", type: "date")]
    private DateTime $checkOut;

    #[Column(type: "integer")]
    private int $arrival;

    #[Column(type: "integer", nullable: true)]
    private ?int $refund;

    #[Column(name: "booking_status", type: "string")]
    private string $bookingStatus;

    #[Column(name: "order_id", type: "string")]
    private string $orderId;

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

    #[Column(name: "trans_resp_mesg", type: "string", nullable: true)]
    private ?string $transRespMesg;

    #[Column(name: "rate_review", type: "integer", nullable: true)]
    private ?int $rateReview;

    #[Column(type: "datetime")]
    private DateTime $datentime;

    public function __construct()
    {
        $this->arrival = 0;
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

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $value): static
    {
        $this->userId = $value;
        return $this;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function setRoomId(int $value): static
    {
        $this->roomId = $value;
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

    public function getArrival(): int
    {
        return $this->arrival;
    }

    public function setArrival(int $value): static
    {
        $this->arrival = $value;
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

    public function getOrderId(): string
    {
        return HtmlDecode($this->orderId);
    }

    public function setOrderId(string $value): static
    {
        $this->orderId = RemoveXss($value);
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

    public function getTransRespMesg(): ?string
    {
        return HtmlDecode($this->transRespMesg);
    }

    public function setTransRespMesg(?string $value): static
    {
        $this->transRespMesg = RemoveXss($value);
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

    public function getDatentime(): DateTime
    {
        return $this->datentime;
    }

    public function setDatentime(DateTime $value): static
    {
        $this->datentime = $value;
        return $this;
    }
}
