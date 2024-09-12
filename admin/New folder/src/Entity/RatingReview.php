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
 * Entity class for "rating_review" table
 */
#[Entity]
#[Table(name: "rating_review")]
class RatingReview extends AbstractEntity
{
    #[Column(name: "sr_no", type: "integer")]
    private int $srNo;

    #[Column(name: "booking_id", type: "integer")]
    private int $bookingId;

    #[Column(name: "room_id", type: "integer")]
    private int $roomId;

    #[Column(name: "user_id", type: "integer")]
    private int $userId;

    #[Column(type: "integer")]
    private int $rating;

    #[Column(type: "string")]
    private string $review;

    #[Column(type: "integer")]
    private int $seen;

    #[Column(type: "datetime")]
    private DateTime $datentime;

    public function __construct()
    {
        $this->seen = 0;
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

    public function getBookingId(): int
    {
        return $this->bookingId;
    }

    public function setBookingId(int $value): static
    {
        $this->bookingId = $value;
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

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $value): static
    {
        $this->userId = $value;
        return $this;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating(int $value): static
    {
        $this->rating = $value;
        return $this;
    }

    public function getReview(): string
    {
        return HtmlDecode($this->review);
    }

    public function setReview(string $value): static
    {
        $this->review = RemoveXss($value);
        return $this;
    }

    public function getSeen(): int
    {
        return $this->seen;
    }

    public function setSeen(int $value): static
    {
        $this->seen = $value;
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
