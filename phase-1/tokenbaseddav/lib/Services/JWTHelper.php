<?php

namespace OCA\TokenBasedDav\Services;

use Error;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use OCP\AppFramework\Utility\ITimeFactory;
use OCP\IConfig;
use OCP\ILogger;

class JWTHelper {

	/**
	 * @var ILogger
	 */
	private $logger;


	/**
	 * @var ConfigManager
	 */
	private $configManager;


	/**
	 * @param ILogger $logger
	 */
	public function __construct(ConfigManager $configManager, ILogger $logger) {
		$this->configManager = $configManager;
		$this->logger = $logger;
	}

	public function validateToken($token){
		$key = $this->configManager->getPublicKey();
		return JWT::decode($token, new Key($key, 'RS256'));
	}

	public function getconfig(){
		return $this->configManager;
	}

}