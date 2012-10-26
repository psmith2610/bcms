<?php

namespace Application\RequestHandler;

class CMS extends \Application\RequestHandler {
	public function dispatch() {

		if ($_SERVER["REQUEST_URI"] == "/error404") {
			header("Status: 404 Not Found", true, 404);
		}

		$xsl_dom = new \DOMDocument();
		$stylesheet_filename = realpath("application/xsl/".$_SERVER["REQUEST_URI"].".xsl");

		if ($stylesheet_filename !== false) {
			if (substr(realpath($stylesheet_filename), 0, strlen(getcwd())) != getcwd()) {
				throw new \Exception("Request resolved to a path outside the working directory");
			}

			if (file_exists($stylesheet_filename)) {
				$xsl_dom->load($stylesheet_filename);
			}else{
				throw new \Exception("Stylesheet could not be found for request URI");
			}
		}else{
			if ($_SERVER["REQUEST_URI"] == "/") {
				$xsl_dom->load("application/xsl/homepage.xsl");
			}else if ($_SERVER["REQUEST_URI"] == "/error404") {
				throw new \Exception("Expected 404 stylesheet, however it did not exist at: framework/xsl/error404.xsl");
			}else{
				header("Location: /error404");
			}
		}

		$xml_dom = new \DOMDocument();
		$xml_dom->load("application/xml/default.xml");

		$xslt = new \XSLTProcessor();
		$xslt->importStylesheet($xsl_dom);

		echo $xslt->transformToXML($xml_dom);
	}
}