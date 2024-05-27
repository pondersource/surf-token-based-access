<?php
namespace OCA\TokenBasedDav\AppInfo;

use OC\AppFramework\DependencyInjection\DIContainer;
use OCA\TokenBasedDav\Services\ConfigManager;
use OCA\TokenBasedDav\Services\JWTHelper;
use \OCP\AppFramework\App;
use \OCA\TokenBasedDav\Controller\AuthController;

class Application extends App {
	public function __construct(array $urlParams=array()) {
		parent::__construct('tokenbaseddav', $urlParams);
		$container = $this->getContainer();

		$container->registerService('OCA\TokenBasedDav\Services\ConfigManager', function (DIContainer $c) {
			$server = $c->getServer();
			$config = $server->getConfig();
			return new ConfigManager($config);
		});

		$container->registerService('OCA\TokenBasedDav\Services\JWTHelper', function ($c) {
			$server = $c->getServer();
			$logger = $server->getLogger();
			$configManager = $c->query('OCA\TokenBasedDav\Services\ConfigManager');
			return new JWTHelper($configManager, $logger);
		});

		$container->registerService('OCA\TokenBasedDav\Controller\AuthController', function ($c) {
			$server = $c->getServer();
			$logger = $server->getLogger();
			$jwtHelper = $c->query('OCA\TokenBasedDav\Services\JWTHelper');
			return new AuthController(
				$c->query('AppName'),
				$c->query('Request'),
				$jwtHelper,
				$logger
			);
		});
	}
}