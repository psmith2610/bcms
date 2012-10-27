bcms
====

Basic PHP Content Management System

Requirement
===========
PECL Libraries:

	1. APC
	
Built in libraries:

	1. XSL

	2. DOMDocument

Installation
============
1. Clone the master repository into /www/sites/bcms.local/

2. Edit Apache httpd.conf, adding the following line to the end:

	Include	/www/sites/bcms.local/config/*.conf

3. Restart apache

4. Edit your PC hosts file to either:

	a) C:\Windows\System32\drivers\etc\hosts	(windows)
		192.168.0.123	bcms.local
	
	b) /etc/hosts	(linux)
		192.168.0.123	bcms.local
		
	c) Have your network administrator add the A record to the DNS server

	(Where 192.168.0.123 is the IP address of your web server)

5. Navigate to "bcms.local" in your web browser.
