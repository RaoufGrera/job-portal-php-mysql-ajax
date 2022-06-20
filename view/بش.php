
<ifModule mod_headers.c>
ExpiresActive On
 
# Expires after 1 month
<filesMatch ".(gif|png|jpg|jpeg|ico|pdf|js|htm|html|txt)$">
Header set Cache-Control "max-age=2592000"
</filesMatch>
 
# Expires after 7 day
<filesMatch ".(css|js)$">
Header set Cache-Control "max-age=2592000"
</filesMatch>
</ifModule> 

#new
<IfModule mod_gzip.c>
mod_gzip_on Yes
mod_gzip_item_include file \.html$
mod_gzip_item_include file \.php$
mod_gzip_item_include file \.css$
mod_gzip_item_include file \.js$
mod_gzip_item_include mime ^application/javascript$
mod_gzip_item_include mime ^application/x-javascript$
mod_gzip_item_include mime ^text/.*
mod_gzip_item_include handler ^application/x-httpd-php
mod_gzip_item_exclude mime ^image/.*
mod_gzip_item_exclude rspheader    ^Content-Encoding:.*gzip.*
</IfModule>


# BEGIN Expire headers
<ifModule mod_expires.c>
  ExpiresActive On
  ExpiresDefault "access plus 5 seconds"
  ExpiresByType image/x-icon "access plus 2592000 seconds"
  ExpiresByType image/jpeg "access plus 2592000 seconds"
  ExpiresByType image/png "access plus 2592000 seconds"
  ExpiresByType image/gif "access plus 2592000 seconds"
  ExpiresByType application/x-shockwave-flash "access plus 2592000 seconds"
  ExpiresByType text/css "access plus 604800 seconds"
  ExpiresByType text/javascript "access plus 216000 seconds"
  ExpiresByType application/javascript "access plus 216000 seconds"
  ExpiresByType application/x-javascript "access plus 216000 seconds"
  ExpiresByType text/html "access plus 600 seconds"
  ExpiresByType application/xhtml+xml "access plus 600 seconds"
</ifModule>
# END Expire headers