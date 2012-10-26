<?php

namespace Framework;

spl_autoload_register('\Framework\classLoader');

function classLoader($class_name) {
	$parts = preg_split('/\\\\/', $class_name);

	if (count($parts) < 2) {
		throw new \Exception("Class name must have a top level namespace. \"$class_name\" must have a namespace prefix. For example \"\\Framework\\{$class_name}\"");
	}

	$module = strtolower(array_shift($parts));
	$class_path = implode("/", $parts);
	$filename = $module."/php/".$class_path.".php";
	$apc_key = "cl_ioctl_".md5($filename);

	if (apc_fetch($apc_key) === "y" || file_exists($filename)) {
		// Store the file exists check for 5 minutes
		apc_store($apc_key, "y", 600);
		require $filename;
	}else{
		throw new \Exception("Class {$class_name} was not found at location ".getcwd()."/{$filename}");
	}
}