<?php

namespace JonyGamesYT9\EntityAPI;

use JonyGamesYT9\EntityAPI\entity\EntityFactory;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class EntityAPI extends PluginBase {
    use SingletonTrait;

    public function onLoad(): void {
        self::setInstance($this);
    }

    public function onEnable(): void {
        EntityFactory::getInstance()->start();
    }
}