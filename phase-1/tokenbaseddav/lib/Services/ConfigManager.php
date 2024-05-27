<?php

namespace OCA\TokenBasedDav\Services;

use OCP\IConfig;
use OCP\Security\ISecureRandom;

class ConfigManager {
	private const appName= "tokenbaseddav";

	private const tokenIssuerPublicKey = "token_issuer_public_key";

	/**
	 * @var IConfig
	 */
	private $config;

	/**
	 * @param IConfig $config
	 */

	public function __construct(IConfig $config) {
		$this->config = $config;
	}


	/**
	 * @description set the public key of token Issuer inside config table
	 * @param $certPath
	 * @return void
	 */
	public function setPublicKey($certPath) {
		$this->config->setAppValue(self::appName, self::tokenIssuerPublicKey, $certPath);
	}

	/**
	 * @description get the public key of token Issuer from config table
	 * @return string
	 */
	public function getPublicKey() {
		return $this->config->getAppValue(self::appName, self::tokenIssuerPublicKey, "");
	}


}