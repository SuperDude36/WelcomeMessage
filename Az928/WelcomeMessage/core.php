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
	  $this->cfg = new Config($this->getDataFolder()."config.yml", Config::YAML, array("Tags#" => "Available tags are: {player}"));
	  $this->cfg = new Config($this->getDataFolder()."config.yml", Config::YAML, array("message" => "§aWelcome To the server, {player}!"));
	  $this->cfg = new Config($this->getDataFolder()."config.yml", Config::YAML, array("owner-name" => "none", "owner-join-message" => "§aGuys, Server owner §e@Unknown §aJoined us!!!", "Note#" => "Prefix is used when useing /announce command", "prefix" => "§7[§aWelcome§cMessage§7]"));
	  $this->saveResource("config.yml");
	}
	public function onDisable(){
	  $this->getLogger()->info("Plugin disabled!");
	}
	public function onJoin(PlayerJoinEvent $event){
		$p = $event->getPlayer();
		$j = $this->cfg->get("owner-join-message");
		$msg = $this->cfg->get("message");
		$msg = str_replace("{player}", $event->getPlayer()->getName(), $msg);
		$name = $event->getPlayer()->getName();
		$owner = $this->cfg->get("owner-name");
		if($name === "$owner"){
			$this->getServer()->broadcastMessage($j);
			$p->sendMessage("§aWelcome back," .TextFormat::GOLD.$name."§a!");
		}else{
			$p->sendMessage("$msg");
	  	}
		}
		public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
			  $prefix = $this->cfg->get("prefix");
		       switch($cmd->getName()){
		           case "announce":
		             $this->getServer()->broadcastMessage($prefix . $args[0]);
		           break;
		           case "aboutwlc":
		             $sender->sendMessage(TextFormat::GREEN."~~~WelcomeMesssge~~~");
		             $sender->sendMessage("§eversion: §a1.0.0");
		             $sender->sendMessage("§a<====RecentChanges====>");
		             $sender->sendMesssge("§e- Added commands + Config.yml");
		             $sender->sendMesssge("§bPlugin by §6Az928, §aGitHub-TheAz928");
		             break;
		}
	}
}
	
