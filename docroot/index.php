<?php

//Bootstrap
chdir("../");
require 'application/php/Bootstrap.php';

if (!function_exists("apache_getenv")) {
	die("This CMS requires Apache");
}

try {
	$registry = Application\RequestHandlerRegistry::getInstance();
	$registry->install("CMS", "\Application\RequestHandler\CMS");

	$bootstrap = Application\Bootstrap::getInstance();
	$bootstrap->dispatch();
}catch(Exception $e) {
	if (apache_getenv("MODE") == "DEV") {
		header("Content-type: text/html; encoding=utf8", true);
		echo "Message: " . $e->getMessage()."<br/>";
		echo "Code: " . $e->getCode()."<br/>";
		echo "Backtrace: <pre>" . print_r($e->getTrace(), true)."</pre><br/>";
		die();
	}
}
