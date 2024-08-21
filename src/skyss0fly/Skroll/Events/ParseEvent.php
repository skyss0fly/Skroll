<?php
namespace Skroll\ParseEvent;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\EventManager;

final class ParseEvent extends PluginBase implements Listener {

  public function errorHandlerEvent(array $args): void {
    $lists = ["Error: A script is unreadable due to a syntax error"];
    
    if (isset($args[0]) && is_int($args[0]) && $args[0] < count($lists)) {
      $this->getLogger()->error($lists[$args[0]]);
    } else {
      $this->getLogger()->error("Unknown error.");
    }
  }

  public function cancelErrorEvent(): bool {
    // Assuming you have some logic to determine if the error can be canceled
    $canCancel = true; // Replace this with your actual logic

    if ($canCancel) {
      return true;
    } else {
      return false;
    }
  }
}
?>
