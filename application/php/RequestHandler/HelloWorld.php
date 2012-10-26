<?php

namespace Application\RequestHandler;

class HelloWorld extends \Application\RequestHandler {
	public function dispatch() {
		echo "Hello World";
	}
}