<?php

namespace JonyGamesYT9\EntityAPI\entity;

use JonyGamesYT9\EntityAPI\entity\types\NPC;
use pocketmine\Player;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\StringTag;

/**
* Class EntityCreator
* @package JonyGamesYT9\EntityAPI\entity
*/
class EntityCreator
{

  /**
  * @param Player $player
  * @param string $name
  * @param float $scale
  * @return void
  */
  public function spawn(Player $player, string $name, float $scale = 1.0): void
  {
    $nbt = new CompoundTag("", [
      new ListTag("Pos", [
        new DoubleTag("", $player->getX()),
        new DoubleTag("", $player->getY()),
        new DoubleTag("", $player->getZ())
      ]),
      new ListTag("Motion", [
        new DoubleTag("", 0),
        new DoubleTag("", 0),
        new DoubleTag("", 0)
      ]),
      new ListTag("Rotation", [
        new FloatTag("", $player->yaw),
        new FloatTag("", $player->pitch)
      ]),
      new CompoundTag("Skin", [
        new StringTag("Data", $player->getSkin()->getSkinData()),
        new StringTag("Name", $player->getSkin()->getSkinData()),
      ]),
    ]);
    if (!empty($name)) {
      $nbt->setString("Name", $name);
    } else {
      $nbt->setString("Name", "");
    }
    $nbt->setFloat("Scale", $scale);
    $human = new NPC($player->getLevel(), $nbt);
    $human->saveNBT();
    $human->setScale($scale);
    $human->setNametagVisible(true);
    $human->setNameTagAlwaysVisible(true);
    $human->setImmobile(true);
    $human->spawnToAll();
  }
}