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
 * Entity class for "room_images" table
 */
#[Entity]
#[Table(name: "room_images")]
class RoomImage extends AbstractEntity
{
    #[Column(name: "sr_no", type: "integer")]
    private int $srNo;

    #[Column(name: "room_id", type: "integer")]
    private int $roomId;

    #[Column(type: "string")]
    private string $image;

    #[Column(type: "boolean")]
    private bool $thumb;

    public function __construct()
    {
        $this->thumb = false;
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

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function setRoomId(int $value): static
    {
        $this->roomId = $value;
        return $this;
    }

    public function getImage(): string
    {
        return HtmlDecode($this->image);
    }

    public function setImage(string $value): static
    {
        $this->image = RemoveXss($value);
        return $this;
    }

    public function getThumb(): bool
    {
        return $this->thumb;
    }

    public function setThumb(bool $value): static
    {
        $this->thumb = $value;
        return $this;
    }
}
