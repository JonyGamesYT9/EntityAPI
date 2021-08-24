<?php

namespace JonyGamesYT9\EntityAPI\entity;

use JonyGamesYT9\EntityAPI\entity\types\NPC;
use pocketmine\Player;
use pocketmine\Server;

/**
* Class EntityEliminator
* @package JonyGamesYT9\EntityAPI\entity
*/
class EntityEliminator
{

  /**
  * @param Player $player
  * @return void
  */
  public function eliminate(Player $player, string $name): void
  {
    foreach ($player->getLevel()->getEntities() as $entities) {
      if ($entities instanceof NPC) {
        if ($entities->getName() === $name) {
          $entities->getCompoundTag()->removeTag("Name");
          $entities->kill();
        }
      }
    }
  }

  /**
  * @return void
  */
  public function eliminateAll(): void
  {
    foreach (Server::getInstance()->getLevels() as $levels) {
      foreach ($levels->getEntities() as $entities) {
        if ($entities instanceof NPC) {
          $entities->getCompoundTag()->removeTag("Name");
          $entities->kill();
        }
      }
    }
  }
}