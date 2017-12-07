USING THEME
1- add a menu called "primary" in the admin
2- add a new page called home and set it to default front page in reading settings


NO WOOCOMMERCE?
1- remove the woocommerce folder
2- remove woocommerce code in wp.css
3- remove woocommerce code in functions.php

GULP
1- terminal to your theme folder
2- type "npm install" in terminal to install all dependencies requires in the package.json file
3- change your proxy url in the gulpfile.js
4- type "gulp" in terminal to run browser sync


NO GULP?
1- remove the package.json file
2- remove the gulpfile.js


SECURITY
1- disable Appearance > Editor, add this to config file: 
define('DISALLOW_FILE_EDIT', true);

2- delete readme.html

3- HARDEN FOLDERS (what Sucuri does)
——————————————————————
wp-content/.htaccess
AND
uploads/.htaccess

<FilesMatch "\.(?i:php)$">
  <IfModule !mod_authz_core.c>
    Order allow,deny
    Deny from all
  </IfModule>
  <IfModule mod_authz_core.c>
    Require all denied
  </IfModule>
</FilesMatch>
——————————————————————

——————————————————————
wp-includes/.htaccess

<FilesMatch "\.(?i:php)$">
  <IfModule !mod_authz_core.c>
    Order allow,deny
    Deny from all
  </IfModule>
  <IfModule mod_authz_core.c>
    Require all denied
  </IfModule>
</FilesMatch>
<Files wp-tinymce.php>
  <IfModule !mod_authz_core.c>
    Allow from all
  </IfModule>
  <IfModule mod_authz_core.c>
    Require all granted
  </IfModule>
</Files>
<Files ms-files.php>
  <IfModule !mod_authz_core.c>
    Allow from all
  </IfModule>
  <IfModule mod_authz_core.c>
    Require all granted
  </IfModule>
</Files>
——————————————————————


OPTIONAL - rename big_city theme to your own them name
1- change bigcity folder theme name to your project
2- inside of style.css, change big city to your project name
3- find and replace “bigcity” with your project name in functions.php
4- activate your new theme name