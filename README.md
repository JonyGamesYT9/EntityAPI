<div align="center">
<h1>EntityAPI | v2.0</h1>
<p>An API of entities so that they can create entities easily.</p>
</div>

<h3>🎮 API Usage:</h3>
<h1>Import the class:</h1>
Put these classes in your plugin, so you can easily access the API.

```php 
<?php 

use JonyGamesYT9\EntityAPI\EntityAPI;
use JonyGamesYT9\EntityAPI\entity\types\NPC;
use JonyGamesYT9\EntityAPI\entity\EntityFactory;
```

<h1>Code to spawn entity:</h1>
Use this method to make an entity appear.

```php 
<?php 

EntityFactory::getInstance()->create($location, $skin, $name, $scale);
```

The $location variable is getting the Location class, In the variable $skin is getting the Skin class, In the variable $name replace it with the name of the entity (No Nametag) (String Tag), In the variable $scale put the size of the entity (Float Scale) (Default: 1.0)

Example:

```php 
<?php

EntityFactory::getInstance()->create(Player->getLocation(), Player->getSkin(), "minigame_1", 1.4);
```

<h1>Code to kill entity:</h1>
Use this code to disappear an entity.

```php 
<?php 

EntityFactory::getInstance()->eliminate($name, $world); // Replace the variable $name with the name of the entity, Replace the variable $world for delete a entities in that world.
```

Example:

```php 
<?php

EntityFactory::getInstance()->eliminate("minigame_1", Player->getPosition()->getWorld());
```


Or to remove all entities use:

```php 
<?php 

EntityFactory::getInstance()->eliminateAll($name); // Doing this will eliminate entities with selected name from all worlds.
```

<h1>Code to create repeating task:</h1>
To create a task with the entity you can use this example:

Import Class:

```php 
<?php

use pocketmine\Server;
use JonyGamesYT9\EntityAPI\entity\types\NPC;
```

Code:

```php 
<?php 

public function onRun(): void {
  foreach (Server::getInstance()->getWorldManager()->getWorlds() as $worlds) {
    foreach ($worlds->getEntities() as $entities) {
      if ($entities instanceof NPC) {
        switch ($entities->getIdName()) {
          case "name":
          $entities->setNameTag("Entity NameTag");
          $entities->setScale($entities->getScaleCustom());
          $entities->setNameTagAlwaysVisible(true);
          break;
        }
      }
    }
  }
}
```

<h1>Code to create an event:</h1>
By doing this example you will make hitting the entity do an action.

Import Class:

```php 
<?php 

use pocketmine\event\entity\EntityDamageEventByEntityEvent;
use pocketmine\player\Player;
use pocketmine\Server;
use JonyGamesYT9\EntityAPI\entity\types\NPC;
```

Code:

```php 
<?php 

public function onDamageNpc(EntityDamageEventByEntityEvent $event): void {
  $npc = $event->getEntity();
  $player = $event->getDamager();
  if ($player instanceof Player && $npc instanceof NPC) {
    switch ($npc->getIdName()) {
      case "name":
      // This is an example that if you hit the entity the player executes the command /me
      Server::getInstance()->dispatchCommand($player, "me Tap an entity with the JonyGamesYT9 API :D");
      $event->cancel(); // Hitting the entity does not take damage
      break;
    }
  }
}
```

<h3>⚡ Features:</h3>
<ul>
<li>Unlimited entities</li>
<li>Easy api usage</li>
<li>PocketMine-MP 4.0.0 (Only)</li>
</ul>

<h3>📋 Icon:</h3>
<p>Icon Credits: https://co.pinterest.com/edison4138/skins-de-minecraft/ </p>

<h3>📖 Project information:</h3>

| Plugin Version | PocketMine API | PHP Version | Plugin Status |
|----------------|--|---|---|
| 2.0            | 4.0.0 | 8 | Completed |
