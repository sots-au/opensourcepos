#!/bin/bash
cp /etc/nginx/sites-available/default /home/site/default
sed -i 's|root /home/site/wwwroot;|root /home/site/wwwroot/public;|g' /home/site/default
sed -i 's|index index.html index.htm;|index index.php index.html index.htm;|g' /home/site/default
service nginx reload

