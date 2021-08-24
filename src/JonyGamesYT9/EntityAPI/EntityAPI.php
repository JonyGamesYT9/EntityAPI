<?php

namespace JonyGamesYT9\EntityAPI;

use JonyGamesYT9\EntityAPI\entity\EntityCreator;
use JonyGamesYT9\EntityAPI\entity\EntityEliminator;
use JonyGamesYT9\EntityAPI\entity\types\NPC;
use pocketmine\plugin\PluginBase;
use pocketmine\entity\Entity;
use pocketmine\Server;

/**
 * Class EntityAPI
 * @package JonyGamesYT9\EntityAPI
 */
class EntityAPI extends PluginBase 
{
  
  /** @var EntityAPI $plugin */
  private static $plugin;
  
  /** @var EntityCreator $creator */
  private $creator;
  
  /** @var EntityEliminator $eliminator */
  private $eliminator;
  
  /**
   * @return void 
   */
  public function onLoad(): void 
  {
    self::$plugin = $this;
    $this->creator = new EntityCreator();
    $this->eliminator = new EntityEliminator();
  }
  
  /**
   * @return void 
   */
  public function onEnable(): void 
  {
    Entity::registerEntity(NPC::class, true);
    foreach (Server::getInstance()->getLevels() as $levels) {
      foreach ($levels->getEntities() as $entities) {
        if ($entities instanceof NPC) {
          if ($entities->getCompoundTag()->getString("Name") === "") {
            $entities->getCompoundTag()->removeTag("Name");
            $entities->kill();
          }
        }
      }
    }
    $this->getLogger()->info("EntityAPI: The API is loaded correctly, all entities loaded.");
  }
  
  /**
   * @return EntityCreator
   */
  public function getEntityCreator(): EntityCreator
  {
    return $this->creator;
  }
  
  /**
   * @return EntityEliminator
   */
  public function getEntityEliminator(): EntityEliminator
  {
    return $this->eliminator;
  }
  
  /**
   * @return EntityAPI
   */
  public static function getPlugin(): EntityAPI
  {
    return self::$plugin;
  }
}