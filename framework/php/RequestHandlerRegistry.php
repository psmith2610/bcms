<?php

namespace Framework;

/**
 * Registry for installing custom handlers for URIs.
 */
class RequestHandlerRegistry {
	private static $instance = null;
	private static $handler_list = array();

	private function __construct() {
		//do nothing
		self::install("Default", "\Framework\RequestHandler\HelloWorld");
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
	/**
	 * Attempts to created an instance of the given handler $name
	 */
	public static function create($name = "HelloWorld") {
		if (array_key_exists($name, self::$handler_list)) {
			$handler_class = self::$handler_list[$name];
			return new $handler_class();
		}else{
			throw new \Exception("The supplied handler name ({$name}) has not been installed. Please install in docroot/index.php");
		}
	}

	/**
	 * Installs the handler identified by the given $name
	 * using the class name $instance. Validation of the supplied
	 * class $instance will be performed at self::create($name)
	 */
	public static function install($name, $instance) {
		if (!is_string($name)) {
			throw new \Exception("Name of instance must be a string");
		} 

		if (!is_string($instance)) {
			throw new \Exception("Instance must be a string representing a class");
		}

		if (!class_exists($instance)) {
			throw new \Exception("Instance must be a valid class");
		}

		self::$handler_list[$name] = $instance;
	}
}