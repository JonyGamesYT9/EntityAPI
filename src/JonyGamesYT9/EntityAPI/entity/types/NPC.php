<?php

namespace JonyGamesYT9\EntityAPI\entity\types;

use pocketmine\level\Level;
use pocketmine\nbt\tag\CompoundTag;

/**
* Class NPC
* @package JonyGamesYT9\EntityAPI\entity\types
*/
class NPC extends \pocketmine\entity\Human
{

  /**
  * NPC constructor.
  * @param Level $level
  * @param CompoundTag $nbt
  */
  public function __construct(Level $level, CompoundTag $nbt)
  {
    parent::__construct($level, $nbt);
  }

  /**
  * @return string
  */
  public function getName(): string
  {
    if ($this->getCompoundTag()->hasTag("Name")) {
      return $this->getCompoundTag()->getString("Name");
    } else {
      return "";
    }
  }

  /**
  * @return string
  */
  public function getFloatScale(): float
  {
    if ($this->getCompoundTag()->hasTag("Scale")) {
      return $this->getCompoundTag()->getFloat("Scale");
    } else {
      return 1.0;
    }
  }

  /**
  * @return CompoundTag
  */
  public function getCompoundTag(): CompoundTag
  {
    return $this->namedtag;
  }
}