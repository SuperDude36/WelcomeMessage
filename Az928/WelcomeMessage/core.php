<?php

namespace Az928\WelcomeMessage;
use pocketmine\plugin\PluginBase as Base;
use pocketmine\event\Event;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
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
	  $this->cfg = new Config($this->getDataFolder()."config.yml", Config::YAML, array("WelcomeMessage Config File by Az928#"));
	  $this->cfg = new Config($this->getDataFolder()."config.yml", Config::YAML, array("message" => "§aWelcome To the server!"));
	  $this->cfg = new Config($this->getDataFolder()."config.yml", Config::YAML, array("owner-name" => "none"));
	  $this->saveResource("config.yml");
	}
	public function onDisable(){
	  $this->getLogger()->info("Plugin disabled!");
	}
	public function onJoin(PlayerJoinEvent $event){
		$p = $event->getPlayer();
		$msg = $this->cfg->get("message");
		$name = $event->getPlayer()->getName();
		$owner = $this->cfg->get("owner-name");
		if($name === "$owner"){
			$this->getServer()->broadcastMessage("§aThe Owner§c" .$name. "§eJoined the game!");
			$p->sendMessage("§aWelcome back," .TextFormat::GOLD.$name."§a!");
		}else{
			$p->sendMessage("$msg");
	  	}
		}
		public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
		       switch($cmd->getName()){
		           case "announce":
		             $this->getServer()->broadcastMessage($args[0]);
		           break;
		           case "aboutwlc":
		             $sender->sendMessage(TextFormat::GREEN."~~~WelcomeMesssge~~~");
		             $sender->sendMessage("§eversion: §a1.1.0");
		             $sender->sendMessage("§a<====RecentChanges====>");
		             $sender->sendMesssge("§e- Fixed Config.yml");
		             $sender->sendMesssge("§bPlugin by §6Az928, §aGitHub-TheAz928");
		             break;
		}
	}
}
	
