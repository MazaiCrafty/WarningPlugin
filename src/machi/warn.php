<?php

namespace machi;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class warn extends PluginBase implements Listener {
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§a[起動] §bWarningPlugin§aを起動しました。");
		if(!file_exists($this->getDataFolder())) mkdir($this->getDataFolder());
		$this->CreateConfig();
	}

	public function onDisable(){
		$this->getLogger()->info("§c[終了] §bWarningPlugin§aを終了しています...")
	}
}