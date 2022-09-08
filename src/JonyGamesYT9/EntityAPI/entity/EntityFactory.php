<?php

namespace JonyGamesYT9\EntityAPI\entity;

use JonyGamesYT9\EntityAPI\entity\types\NPC;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\Human;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\Server;
use pocketmine\utils\SingletonTrait;
use pocketmine\world\World;

class EntityFactory {
    use SingletonTrait;

    public function start(): void {
        \pocketmine\entity\EntityFactory::getInstance()->register(NPC::class, function (World $world, CompoundTag $compoundTag): NPC {
            return new NPC(EntityDataHelper::parseLocation($compoundTag, $world), Human::parseSkinNBT($compoundTag), $compoundTag);
        }, ["minecraft:entityapi:npc"]);
    }

    public function create(Location $location, Skin $skin, string $name, float $scale): void {
        $npc = new NPC($location, $skin);
        $npc->setIdName($name);
        $npc->setScaleCustom($scale);
        $npc->setNameTagAlwaysVisible();
        $npc->setNameTagVisible();
        $npc->spawnToAll();
        $npc->setCanSaveWithChunk(true);
    }

    public function eliminateAll(string $id_name): void {
        foreach (Server::getInstance()->getWorldManager()->getWorlds() as $world) {
            foreach ($world->getEntities() as $entities) {
                if ($entities instanceof NPC) {
                    if ($entities->equals($id_name)) {
                        $entities->flagForDespawn();
                    }
                }
            }
        }
    }

    public function eliminate(string $id_name, World $world): void {
        foreach ($world->getEntities() as $entities) {
            if ($entities instanceof NPC) {
                if ($entities->equals($id_name)) {
                    $entities->flagForDespawn();
                }
            }
        }
    }
}