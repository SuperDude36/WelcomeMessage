<?php

namespace Az928\WelcomeMessage;
use pocketmine\plugin\PluginBase as Base;
use pocketmine\event\Event;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class core extends Base implements Listener{
	public $cfg;
	
	public function onLoad(){
		$this->getLogger()->info("Loading...");
	}
	public function onEnable(){
	  $this->getServer()->getLogger()->info("[WelcomeMessage] Loaded!");
	  $this->getServer()->getPluginManager()->registerEvents($this,$this);
	  @mkdir($this->getDataFolder());
	  $cfg = new Config($this->getDataFolder()."config.yml", Config::YAML);
	  $this->saveDefaultConfig();
	}
	public function onJoin(PlayerJoinEvent $event){
		$this->cfg = $this->getConfig();
		$p = $event->getPlayer();
		$msg = $this->cfg->get("message");
		$name = $event->getPlayer()->getName();
		$owner = $this->cfg->get("owner-name");
		if($name === "$owner"){
			$this->getServer()->broadcastMessage("§aThe Owner§c".$name."§eJoined the game!");
			$p->sendMessage("§bWelcome back!");
		}else{
			$p->sendMessage("$msg");
		}
	}
}
