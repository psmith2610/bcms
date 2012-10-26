<?php

namespace Application;

abstract class RequestHandler {
	abstract public function dispatch();
}