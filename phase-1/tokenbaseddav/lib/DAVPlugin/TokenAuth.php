<?php
namespace OCA\TokenBasedDav\DAVPlugin;

use Sabre\DAV;
use Sabre\DAV\Exception\BadRequest;
use Sabre\HTTP\RequestInterface;
use Sabre\HTTP\ResponseInterface;
use Sabre\VObject;

class TokenAuth extends DAV\ServerPlugin
{
    public function initialize(DAV\Server $server) {
		$this->server = $server;
		$server->on('method:POST', [$this, 'httpPost'], 90);
	}

    public function httpPost(RequestInterface $request, ResponseInterface $response) {
		$queryParams = $request->getQueryParameters();
		if (!\array_key_exists('token-access', $queryParams)) {
			return;
		}

	}
}