<?php

namespace JonyGamesYT9\EntityAPI\entity\types;

use pocketmine\entity\Human;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\nbt\tag\CompoundTag;

class NPC extends Human {

    public const ERROR = "Unknown";

    private string $id_name;

    private float $scales;

    public function __construct(Location $location, Skin $skin, ?CompoundTag $nbt = null) {
        parent::__construct($location, $skin, $nbt);
    }

    public function initEntity(CompoundTag $nbt): void {
        parent::initEntity($nbt);
        $this->setIdName($nbt->getString("npc_type", self::ERROR));
        $this->setScaleCustom($nbt->getFloat("scale_amount", 0.1));
    }

    public function saveNBT(): CompoundTag {
        $nbt = parent::saveNBT();
        $nbt->setString("npc_type", $this->getIdName());
        $nbt->setFloat("scale_amount", $this->getScaleCustom());
        return $nbt;
    }

    public function getIdName(): string {
        return $this->id_name;
    }

    public function setIdName(string $id_name): void {
        $this->id_name = $id_name;
    }

    public function getScaleCustom(): float {
        return $this->scales;
    }

    public function setScaleCustom(float $scale_amount): void {
        $this->scales = $scale_amount;
    }

    public function equals(string $id_name): bool {
        return $this->getIdName() === $id_name;
    }
}