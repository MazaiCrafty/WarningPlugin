<?php
namespace machi;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerChatEvent;

class EventListener implements Listener{

    private $plugin;

    public function __construct(warn $plugin){
        $this->plugin = $plugin;
        $this->plugin->getServer()->getPluginManager()->registerEvents($this, $plugin);
    }
    
    public function onJoin(PlayerJoinEvent $event): void{
        $player = $event->getPlayer();
        $name = $player->getName();
        if ($this->plugin->list->exists($name)){
            $type = $this->plugin->list->get($name);
            switch ($type){
                case warn::RELEASE:
                    $color = "§r";
                    break;
                case warn::YELLOW_WARNING:
                    $color = "§e⚠§r";
                    break;
                case warn::ORANGE_WARNING:
                    $color = "§6⚠§r";
                    break;
                case warn::PINK_WARNING:
                    $color = "§d⚠§r";
                    break;
                case warn::RED_WARNING:
                    $color = "§c⚠§r";
                    break;
            }
            $player->setDisplayName($color . $name);
        }
    }

    public function onBlockBreak(BlockBreakEvent $event): void{
        $player = $event->getPlayer();
        $name = $player->getName();
        if ($this->plugin->list->exists($name)){
            if (($this->plugin->list->get($name) === 2) || ($this->plugin->list->get($name) === 3) || ($this->plugin->list->get($name) === 4)){
                $player->sendMessage("§l§cブロックの変更は制限されています。");
                $event->setCancelled();
            }
        }
    }

    public function onBlockPlace(BlockPlaceEvent $event): void{
        $player = $event->getPlayer();
        $name = $player->getName();
        if ($this->plugin->list->exists($name)){
            if (($this->plugin->list->get($name) === 2) || ($this->plugin->list->get($name) === 3) || ($this->plugin->list->get($name) === 4)){
                $player->sendMessage("§l§cブロックの変更は制限されています。");
                $event->setCancelled();
            }
        }
    }

    public function commandProcess(PlayerCommandPreprocessEvent $event): void{
        $player = $event->getPlayer();
        $name = $player->getName();
        if ($this->plugin->list->exists($name)){
            if (($this->plugin->list->get($name) === 3) || ($this->plugin->list->get($name) === 4)){
                $player->sendMessage("§l§cコマンドの使用は制限されています。");
                $event->setCancelled();
            }
        }
    }

    public function onPlayerChat(PlayerChatEvent $event): void{
        $player = $event->getPlayer();
        $name = $player->getName();
        if ($this->plugin->list->get($name)){
            if ($this->plugin->list->get($name) === 4){
                $player->sendMessage("§l§cチャットは制限されています。");
                $event->setCancelled();
            }
        }
    }
}
