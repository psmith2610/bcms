<?php

namespace Framework\RequestHandler;

class HelloWorld extends \Framework\RequestHandler {
	public function dispatch() {
		echo "Hello World";
	}
}