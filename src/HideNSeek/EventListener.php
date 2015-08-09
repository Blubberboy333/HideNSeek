<?php

namespace HideNSeek;

use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class EventListener implements Listener{
	public $plugin;
	
	public function __construct(Main $plugin){
		$this->plugin = $plugin;
	}
	
	// When a player quits
	public function onPlayerQuitEvent(PlayerQuitEvent $event){
		$player = $event->getPlayer();
		// Map1
		if(in_array($player->getName(), $this->plugin->map1)){
			unset($this->plugin->map1[$player->getName()]);
		}elseif(in_array($player->getName(), $this->plugun->map1Hunters)){
			unset($this->plugin->map1[$player->getName());
			
		// Map2
		}elseif(in_array($player->getName(), $this->plugin->map2[$player->getName()])){
			unset($this->plugin->map2[$player->getName());
		}elseif(in_array($player->getName(), $this->plugin->map2Hunters[$player->getName())){
			unset($this->plugin->map2Hunters[$player->getName());
			
		// Map3
		}elseif(in_array($player->getName(), $this->plugin->map3[$player->getName()])){
			unset($this->plugin->map3[$player->getName());
		}elseif(in_array($player->getName(), $this->plugin->map3Hunters[$player->getName())){
			unset($this->plugin->map3Hunters[$player->getName());
		}
	}
	
	// When a player hits another player
	public function onEntityDamageByEntityEvent(EntityDamageByEntityEvent $event){
		$entity = $event->getEntity();
		$damager = $event->getDamager();
		
		if(!(in_array($damager, $this->plugin->map1) || in_array($damager, $this->plugin->map1Hunters) || in_array($damager, $this->plugin->map2) || in_array($damager, $this->plugin->map2Hunters) || in_array($damager, $this->plugin->map3) || in_array($damager, $this->plugin->map3Hunters)
		// Hiders
		}elseif(in_array($entity, $this->plugin->map1) && in_array($damager, $this->plugin->map1) || in_array($entity, $this->plugin->map2) && in_array($damager, $this->plugin->map2) || in_array($entity, $this->plugin->map3) && in_array($damager, $this->plugin->map3)){
			$event->setCancelled(true);
		
		// Seekers
		}elseif(in_array($entity, $this->plugin->map1Hunters) && in_array($damager, $this->plugin->map1Hunters) || in_array($entity, $this->plugin->map2Hunters) && in_array($damager, $this->plugin->map2Hunters) || in_array($entity, $this->plugin->map3Hunters) && in_array($damager, $this->plugin->map3Hunters)){
			$event->setCancelled(true);
		}
	}
}
