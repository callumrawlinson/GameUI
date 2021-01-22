<?php

namespace game;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\entity\{Effect, EffectInstance, Entity};
use pocketmine\Player;
use UIAPI\{Form, ModalForm, SimpleForm, CustomForm};
use UIS\KickUI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

class Owner extends PluginBase implements Listener {
	
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::GREEN . "GameUI was Activated \n\n\n COVID-19 \n\n\n WASH YOUR HANDS");
    }
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "GameUI was Deactivated \n\n\n COVID-19 \n\n\n WASH YOUR HANDS");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "games":
                if ($sender->hasPermission("list.games")){
                     $this->Menu($sender);
                }else{     
                     $sender->sendMessage(TextFormat::RED . "§You do not have permission to use the Game UI");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
   
    public function Menu($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null){
            $result = $data;
            if($result === null){
			return true;
            }             
            switch($result){
               case 0:
$this->getServer()->dispatchCommand($sender, "tb join");
                break;   
               case 1:
$this->getServer()->dispatchCommand($sender, "mdr join MMHUB");
                break;   			
               case 2:
$this->getServer()->dispatchCommand($sender, "mw tp HotBlock");
                break;   	
               case 3:
$this->getServer()->dispatchCommand($sender, "sw join");
                break;   
               case 4:
$this->getServer()->dispatchCommand($sender, "hub");
                break;   	    			    
            }
        });
        $form->setTitle("§f§lGameUI");
        $form->setContent("§3Choose a game!");
        $form->addButton("§l§eThe Bridge\n§r§0Select",0,"textures/ui/conduit_power_effect");
	    $form->addButton("§l§eMurder Mystery\n§r§0Select",1,"textures/ui/conduit_power_effect");
	    $form->addButton("§l§eHotBlock\n§r§0Select",2,"textures/ui/conduit_power_effect");
	    $form->addButton("§l§eSkywars\n§r§0Select",3,"textures/ui/conduit_power_effect");
	    $form->addButton("§l§eHub\n§r§0Select",4,"textures/ui/conduit_power_effect");
        $form->sendToPlayer($sender);
            return $form;
    }
}
