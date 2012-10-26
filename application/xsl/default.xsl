<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" doctype-system="about:legacy-compat" encoding="UTF-8" indent="no" />
	<xsl:template match="/">
		<html>
			<head>
				<title><xsl:value-of select="/page/head/title"/></title>
			</head>
			<body>
				<xsl:call-template name="body"/>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
