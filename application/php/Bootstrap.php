<?php

namespace Application;

require 'application/php/ClassLoader.php';

/**
 * Singleton instance of the framework boostrap code
 */
class Bootstrap {
	private static $instance = null;

	private function __construct() {
		//do nothing
	}

	public function dispatch() {
		$request_handler = RequestHandlerRegistry::getInstance()->create($_GET['__handler']);
		$request_handler->dispatch();
	}

	/**
	 * Get the instance of Boostrap to handle the request
	 */
	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}