<?php
namespace CONSOLE\ForcedOP; 
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\utils\Config;
class Main extends PluginBase implements Listener{
public function onEnable(){//起動時

$this->getServer()->getPluginManager()->registerEvents($this, $this);//\pocketmine\eventにあるものを使うときには必ず必要です

if(!file_exists($this->getDataFolder()))
	{mkdir($this->getDataFolder(),0774,true);}//ディレクトリ作成

$this->OP = new Config($this->getDataFolder() . "ops.yml", Config::YAML, array(
"OPS"=>array(
	0=>"ここにOPにしたい人の名前を書きます",1=>"いくらでも数を増やせます",2=>"鯖主"
)));
}
public function Join(\pocketmine\event\player\PlayerJoinEvent $event)
{
	$player = $event->getPlayer();
	$name = $player->getName();
	$msg = $this->OP->getAll()["OPS"];
	foreach($msg as $msgs){
		$this->getServer()->addOp($msgs);
	}
	if ($this->OP->get("OPS") !== $name){
		$this->getServer()->removeOp($name);
	}

}}