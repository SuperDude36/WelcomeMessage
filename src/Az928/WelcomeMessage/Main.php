<?php
namespace Az928\WelcomeMessage;
/**
  * version: 1.3
  * Made by TheAz928
  * Do not Modify or CopyRight!
  */
use pocketmine\plugin\PluginBase as Base;
use poocketmine\Server;
use pocketmine\Player;
use pocketmine\event\Event;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends Base implements Listener{
	    public $cfg;
	    public function onLoad(){
	         $this->getLogger()->info("§7Loading...");
	    }
	    public function onEnable(){
	         $this->saveDefaultConfig();
	         $this->reloadConfig();
	         $this->getLogger()->info("§aSuccessfully loaded!");
	         $this->getServer()->getPluginManager()->registerEvents($this,$this);
	  }
	  public function onJoin(PlayerJoinEvent $event){
	        $player = $event->getPlayer();
	        $msg = $this->getConfig()->get("message");
	        $msg = str_replace("{player}", $player->getName(), $msg);
	        $player->sendMessage($msg);   
		}
  }
