<?php

namespace JonyGamesYT9\EntityAPI\entity\types;

/**
* Class NPC
* @package JonyGamesYT9\EntityAPI\entity\types
*/
class NPC extends \pocketmine\entity\Human
{

  /**
  * @return string
  */
  public function getName(): string
  {
    if ($this->getCompoundTag()->hasTag("Name")) {
      return $this->getCompoundTag()->getString("Name");
    }
    return "";
  }

  /**
  * @return float
  */
  public function getFloatScale(): float
  {
    if ($this->getCompoundTag()->hasTag("Scale")) {
      return $this->getCompoundTag()->getFloat("Scale");
    }
    return 1.0;
  }

  /**
  * @return CompoundTag
  */
  public function getCompoundTag(): CompoundTag
  {
    return $this->namedtag;
  }
}
