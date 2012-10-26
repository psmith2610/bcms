<?php

//Bootstrap
chdir("../");
require 'framework/php/Bootstrap.php';

if (!function_exists("apache_getenv")) {
	die("This CMS requires Apache");
}

try {
	$bootstrap = Framework\Bootstrap::getInstance();
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
