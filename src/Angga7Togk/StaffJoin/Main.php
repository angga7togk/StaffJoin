<?php

namespace Angga7Togk\StaffJoin;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {
    
    public Config $config;
    
    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
    }
    
    public function onJoin(PlayerJoinEvent $event) {
        $event->setJoinMessage("");
        $player = $event->getPlayer();
        
        for($i = 1;$i <= 100;$i++){
            if($this->config->exists($i)){
                if($player->hasPermission($this->config->get($i)["Permission"])){
                    $this->getServer()->broadcastMessage($this->config->get($i)["Prefix"]." ".str_replace ("{player}", $player->getName(), $this->config->get($i)["Message-Join"]));
                }
            }
        }
    }
    
    public function onQuit(PlayerQuitEvent $event) {
        $event->setQuitMessage("");
        $player = $event->getPlayer();
        
        for($i = 1;$i <= 100;$i++){
            if($this->config->exists($i)){
                if($player->hasPermission($this->config->get($i)["Permission"])){
                    $this->getServer()->broadcastMessage($this->config->get($i)["Prefix"]." ".str_replace ("{player}", $player->getName(), $this->config->get($i)["Message-Quit"]));
                }
            }
        }
    }
}
