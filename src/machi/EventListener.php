<?php
namespace machi;

use pocketmine\{
    event\Listener
};

class EventListener implements Listener
{
    private $plugin = null;
    public function __construct(warn $plugin)
    {
        $this->plugin = $plugin;
    }
}
