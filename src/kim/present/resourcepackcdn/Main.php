<?php

/**
 *  ____                           _   _  ___
 * |  _ \ _ __ ___  ___  ___ _ __ | |_| |/ (_)_ __ ___
 * | |_) | '__/ _ \/ __|/ _ \ '_ \| __| ' /| | '_ ` _ \
 * |  __/| | |  __/\__ \  __/ | | | |_| . \| | | | | | |
 * |_|   |_|  \___||___/\___|_| |_|\__|_|\_\_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author       PresentKim (debe3721@gmail.com)
 * @link         https://github.com/PresentKim
 * @license      https://www.gnu.org/licenses/lgpl-3.0 LGPL-3.0 License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 *
 * @noinspection PhpUnused
 */

declare(strict_types=1);

namespace kim\present\resourcepackcdn;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\ResourcePacksInfoPacket;
use pocketmine\plugin\PluginBase;
use pocketmine\resourcepacks\ZippedResourcePack;
use pocketmine\scheduler\ClosureTask;
use Symfony\Component\Filesystem\Path;

use function array_merge;
use function rtrim;
use function strlen;
use function strrchr;
use function substr;

final class Main extends PluginBase implements Listener{
	/** @var string[] */
	private array $cdnUrls = [];

	private string $cdnBaseUrl;
	private string $cdnBaseDir;
	private bool $removeExtension;

	protected function onEnable() : void{
		$config = $this->getConfig();
		$serverDir = $this->getServer()->getDataPath();
		$this->cdnBaseUrl = rtrim($config->get("base_url", "https://cdn.example.com/"), "/") . "/";
		$this->cdnBaseDir = rtrim(Path::join($serverDir, $config->get("base_dir", "./resource_packs")), "/") . "/";
		$this->removeExtension = (bool) $config->get("remove_extension", false);

		$this->getServer()->getPluginManager()->registerEvents($this, $this);

		// Run matching immediately to check for resource packs added before this plugin.
		$this->matchPackInCdnDir();

		// Run matching after 1 tick to check for resource packs added later than this plugin.
		$this->getScheduler()->scheduleDelayedTask(new ClosureTask(fn() => $this->matchPackInCdnDir()), 1);
	}

	private function matchPackInCdnDir() : void{
		$resourcePackManager = $this->getServer()->getResourcePackManager();
		foreach($resourcePackManager->getResourceStack() as $pack){
			if(
				$pack instanceof ZippedResourcePack
				&& Path::isBasePath($this->cdnBaseDir, $pack->getPath())
			){
				$uuid = $pack->getPackId();
				$version = $pack->getPackVersion();
				$key = $uuid . "_" . $version;
				if(isset($this->cdnUrls[$key])){
					continue;
				}
				$cdnUrl = $this->cdnBaseUrl . Path::makeRelative($pack->getPath(), $this->cdnBaseDir);
				if($this->removeExtension){
					$cdnUrl = substr($cdnUrl, 0, -strlen(strrchr($cdnUrl, ".")));
				}
				$this->getLogger()->info("Registered CDN URL for {$pack->getPackName()}_v$version ($uuid) : $cdnUrl");
				$this->cdnUrls[$key] = $cdnUrl;
			}
		}
	}

	/** @priority HIGHEST */
	public function onDataPacketSend(DataPacketSendEvent $event) : void{
		foreach($event->getPackets() as $packet){
			if($packet instanceof ResourcePacksInfoPacket){
				$packet->cdnUrls = array_merge($this->cdnUrls, $packet->cdnUrls);
			}
		}
	}
}
