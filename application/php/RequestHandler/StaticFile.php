<?php

namespace Application\RequestHandler;

class StaticFile extends \Application\RequestHandler {
	public function dispatch() {

		// If we are rendering a 404 page, display the correct HTTP status code
		if ($_SERVER["REQUEST_URI"] == "/error404") {
			header("Status: 404 Not Found", true, 404);
		}

		// Create the filename for the script and use realpath to verify
		// that it is a valid file and within our base directory.
		$xsl_dom = new \DOMDocument();
		$stylesheet_filename = realpath("application/xsl/static/".$_SERVER["REQUEST_URI"].".xsl");

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
			// If we don't have any URI then rendering the homepage
			if ($_SERVER["REQUEST_URI"] == "/") {
				$xsl_dom->load("application/xsl/static/homepage.xsl");
			}else if ($_SERVER["REQUEST_URI"] == "/error404") {
				throw new \Exception("Expected 404 stylesheet, however it did not exist at: framework/xsl/error404.xsl");
			}else{
				header("Location: /error404");
			}
		}

		// Load the default XML file if no custom one exist
		$xml_dom = new \DOMDocument();
		$xml_filename = realpath("application/xml/static/".$_SERVER["REQUEST_URI"].".xml");
		if ($xml_filename !== false) {
			if (substr(realpath($xml_filename), 0, strlen(getcwd())) != getcwd()) {
				throw new \Exception("Request resolved to a path outside the working directory");
			}

			if (file_exists($xml_filename)) {
				$xml_dom->load($xml_filename);
			}else{
				$xml_dom->load("application/xml/default.xml");
			}
		}else{
			$xml_dom->load("application/xml/default.xml");
		}

		$xslt = new \XSLTProcessor();
		$xslt->importStylesheet($xsl_dom);

		echo $xslt->transformToXML($xml_dom);
	}
}