<?php

/*
 * ModernEcon
 *
 * Copyright (C) 2019 ModernPlugins
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace ModernPlugins\ModernEcon\Core;

use Generator;
use Logger;
use ModernPlugins\ModernEcon\Configuration\Configuration;
use ModernPlugins\ModernEcon\Core\Currency\CurrencyManager;
use ModernPlugins\ModernEcon\Master\MasterManager;
use ModernPlugins\ModernEcon\Utils\AwaitDataConnector;
use pocketmine\plugin\Plugin;
use PrefixedLogger;

final class CoreModule{
	/** @var Plugin */
	private $plugin;
	/** @var Logger */
	private $logger;
	/** @var AwaitDataConnector */
	private $db;
	/** @var Configuration */
	private $configuration;

	private $currencyManager;

	public static function create(Plugin $plugin, Logger $logger, AwaitDataConnector $db, Configuration $configuration, MasterManager $masterManager, bool $creating) : Generator{
		$module = new CoreModule();
		$module->plugin = $plugin;
		$module->logger = $logger;
		$module->db = $db;
		$module->configuration = $configuration;

		$module->currencyManager = yield CurrencyManager::create(new PrefixedLogger($logger, "Currency"),
			$db, $masterManager, $creating);


		return $module;
	}


	public function shutdown() : void{
	}

	private function __construct(){
	}
}
