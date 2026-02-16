#!/bin/bash
cp /etc/nginx/sites-available/default /tmp/default
sed --in-place --follow-symlinks 's|root /home/site/wwwroot;|root /home/site/wwwroot/public;|g' /tmp/default
sed --in-place --follow-symlinks 's|index index.html index.htm;|index index.php index.html index.htm;|g' /tmp/default
cp /tmp/default /etc/nginx/sites-available/default
service nginx reload
