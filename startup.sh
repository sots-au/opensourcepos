#!/bin/bash

# Copy default config to a writable temp location
cp /etc/nginx/sites-available/default /tmp/default

# Modify the config safely
sed --in-place --follow-symlinks 's|root /home/site/wwwroot;|root /home/site/wwwroot/public;|g' /tmp/default
sed --in-place --follow-symlinks 's|index index.html index.htm;|index index.php index.html index.htm;|g' /tmp/default

# Replace the original config
cp /tmp/default /etc/nginx/sites-available/default

# Reload nginx
service nginx reload
