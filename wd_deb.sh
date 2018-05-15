#! /usr/bin/env sh
sudo apt-get update
sudo apt-get install apache2 php7.0 php7.0-curl php7.0-gd php7.0-imap php7.0-json php7.0-mcrypt php7.0-mysql php7.0-opcache php7.0-xmlrpc libapache2-mod-php7.0
sudo apt-get install php-zip
sudo apt-get install php-dom
cd /var/www/html/
sudo wget "https://github.com/WebDesk-me/Webdesk-me/archive/master.zip"
sudo apt-get install unzip
sudo unzip /var/www/html/master.zip -d /var/www/html/
sudo cp -a /var/www/html/Webdesk-me-master/. /var/www/html/
sudo rm -f /var/www/html/master.zip
sudo rm -rf /var/www/html/Webdesk-me-master/
sudo chgrp -R www-data /var/www/
sudo chmod -R g+w /var/www/
sudo find /var/www -type d -exec chmod 2775 {} \;
sudo find /var/www -type f -exec chmod ug+rw {} \;
sudo apachectl -k restart
hostname -I
