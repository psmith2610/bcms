<?php

namespace Application\RequestHandler;

class CMS extends \Application\RequestHandler {
	public function dispatch() {
		$xsl_dom = new \DOMDocument();
		$xsl_dom->load("application/xsl/default.xsl");

		$xml_dom = new \DOMDocument();
		$xml_dom->load("application/xml/default.xml");

		$xslt = new \XSLTProcessor();
		$xslt->importStylesheet($xsl_dom);

		echo $xslt->transformToXML($xml_dom);
	}
}