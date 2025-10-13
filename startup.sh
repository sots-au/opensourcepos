#!/bin/bash
cp /etc/nginx/sites-available/default /home/site/default
TMPDIR=/tmp
sed --in-place --follow-symlinks 's|root /home/site/wwwroot;|root /home/site/wwwroot/public;|g' /home/site/default
sed --in-place --follow-symlinks 's|index index.html index.htm;|index index.php index.html index.htm;|g' /home/site/default
nginx -s reload
