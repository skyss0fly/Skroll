<?php
namespace Skroll\ParseEvent;

use pocketmine\plugin\PluginBase;
use pocketmine\event\EventManager;
use pocketmine\event\EventListener;

final class ParseEvent extends PluginBase {

  public function errorHandlerEvent(Array $args ): void {
    $lists = ["Error: A script is Unreadble due to A Syntax Error"];
    
$this->getLogger()->error($lists[$args]);
    
  }

  public function cancelErrorEvent() bool {

    if // error cannot be canceled then return false

    else // return true;

      
  }
  
}

?>
