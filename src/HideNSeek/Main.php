<?php

namespace HideNSeek;

use pocketmine\plugin\PluginBase;
use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocetmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;

class Main extends PluginBase implements Listener{
	// Map1 variables
	public $seconds1 = 0;
	public $map1 = array();
	public $map1Hunters = array();
	// Map2 variables
	public $map2 = array();
	public $map2Hunters = array();
	public $seconds2 = 0;
	// Map3 variables
	public $map3 = array();
	public $map3Hunters = array();
	public $seconds3 = 0;

	public $taskId;
	
	public function onEnable(){
		
		$this->saveDefaultConfig();
		$this->getLogger()->info(TextFormat::GREEN."HideNSeek enabled");
		$this->mapsRunning = array();
	}
	public function onDisable(){
		$this->getLogger()->info(TextFormat::RED."HideNSeek disabled");
	}
	
	public function startMap($map){
		if($map == "map1"){
			$this->mapsRunning["map1"] = "map1";
			$hunter = array_rand($this->map1);
			unset($this->map1[$hunter]);
			$player = $this->getServer()->getPlayer($hunter);
			$this->getServer()->getPlayer($hunter)->teleport(new Vector3(108, 1, 165));
			$player->getInventory()->setArmorItem("Head", Item::get(310));
			$player->getInventory()->setArmorItem("Chest", Item::get(311));
			$player->getInventory()->setArmorItem("Legs", Item::get(312));
			$player->getInventory()->setArmorItem("Feet", Item::get(313));
			$player->getInventory()->addItem(Item::get(276));
			
			foreach($this->getServer()->getOnlinePlayers() as $p){
				if(isset($this->map1[$p->getName()])){
					$p->teleport(new Vector3(121, 4, 157));
					$p->sendPopup(TextFormat::GREEN."Find a place to hide!");
					$p->getInventory()->setArmorItem("Head", Item::get(298));
					$p->getInventory()->setArmorItem("Chest", Item::get(299));
					$p->getInventory()->setArmorItem("Legs", Item::get(300));
					$p->getInventory()->setArmorItem("Feet", Item::get(334));
				}
			}
		}
	}
}
