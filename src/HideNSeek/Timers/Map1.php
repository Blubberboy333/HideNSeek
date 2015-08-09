<?php

namespace HideNSeek\Timers;

use pocketmine\scheduler\PluginTask;
use HideNSeek\Main;

class Map1 extends PluginTask{
	public function __construct(Main $plugin){
		$this->plugin = $plugin;
		parent::__construct($plugin);
	}
	
	public function onRun($tick){
		if(in_array("map1"), $this->plugin->mapsRunning){
			$this->plugin->seconds1++;
			if($this->plugin->seconds1 == 0){
				foreach($this->plugin->getServer()->getPlayers() as $p){
					if($this->plugin->map1[$p->getName()] !== null || $this->plugin->map1Hunters[$p->getName()]){
						$p->sendPopup("The match will start in 1 minute");
					}
				}
			}elseif($this->plugin->seconds1 == 30){
				foreach($this->plugin->getServer()->getPlayers() as $p){
					if($this->plugin->map1[$p->getName()] !== null || $this->plugin->map1Hunters[$p->getName()]){
						$p->sendPopup("The match will start in 30 seconds");
					}
				}
			}elseif($this->plugin->seconds1 == 60){
				$this->plugin->seconds1 = 0;
				unset($this->plugin->mapsRunning["map1"]);
				foreach($this->plugin->getServer()->getPlayers() as $p){
					if($this->plugin->map1[$p->getName()] !== null || $this->plugin->map1Hunters[$p->getName()]){
						$p->sendPopup("Match started!");
					}
				}
			}
		}
	}
}
