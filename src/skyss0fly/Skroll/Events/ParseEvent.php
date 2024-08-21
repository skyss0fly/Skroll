
<?php
namespace Skroll\ParseEvent;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\EventManager;
use pocketmine\Server;

final class ParseEvent extends PluginBase implements Listener {

  public function onEnable(): void {
    $this->getLogger()->info("ParseEvent plugin enabled.");
    $this->loadAndParseScripts();
  }

  private function loadAndParseScripts(): void {
    $resourceFolder = $this->getDataFolder() . "resources/";
    if (!is_dir($resourceFolder)) {
      $this->getLogger()->error("Resource folder not found.");
      return;
    }

    $files = glob($resourceFolder . "*.sk");
    foreach ($files as $file) {
      $this->parseAndRunScript(file_get_contents($file));
    }
  }

  private function parseAndRunScript(string $scriptContent): void {
    // Split the script into lines
    $lines = explode("\n", $scriptContent);

    foreach ($lines as $line) {
      $line = trim($line);
      if (empty($line)) {
        continue;
      }

      // Parse the script line by line
      if (preg_match('/@(.+?)@ \{(.+?)\} \*(.+?)\* do:/', $line, $matches)) {
        $event = $matches[1];
        $variable = $matches[2];
        $action =  $matches[3];

        // Handle the parsed event, variable, and action
        $this->handleScriptEvent($event, $variable, $action);
      } else {
        $this->getLogger()->warning("Unrecognized script line: $line");
      }
    }
  }

  private function handleScriptEvent(string $event, string $variable, string $action): void {
    // Implement the logic to handle the event, variable, and action
    switch ($event) {
      case 'onPlayerJoin':
        // Example: onPlayerJoin {playerName} *sendWelcomeMessage* do:
        $this->sendWelcomeMessage($variable);
        break;
      case 'onPlayerLeave':
        // Example: onPlayerLeave {playerName} *sendGoodbyeMessage* do:
        $this->sendGoodbyeMessage($variable);
        break;
      default:       
        $this->getLogger()->warning("Unhandled event: $event");
        break;
    }
  }

  private function sendWelcomeMessage(string $playerName): void {
    // Logic to send a welcome message to the player
    $message = "Welcome to the server, $playerName!";
    $this->getServer()->broadcastMessage($message);
  }

  private function sendGoodbyeMessage(string $playerName): void {
    // Logic to send a goodbye message to the player
    $message = "Goodbye, $playerName! Hope to see you again soon!";
    $this->getServer()->broadcastMessage($message);
  }
}
