# Medical office web application
This is the repository for my final degree project.

# assets folder
This folder contains a lot of stuff related to the project resources, things as:
  1. CSS sheets
  2. Javascript code
  3. Images
  4. Uploads folder for the files that the app generates

# config folder
This folder contains escential code from the aplication. You can see my SQL database construction on "database.sql" or some of my SQL instructions that i used 
in the application on "insets.sql".

# Important information 
".htaccess" files are not allowed to be in te repository, so you have to add ".htaccess" file for two locations:
  1. appFolder/home/.htaccess
  2. appFolder/consultas/.htaccess

That file is VERY important because the web routes function with two parameters: controller and action (MVC), so the web must be able to understand route www.application.com/parameter1/parameter2 as www.application.com?controller=parameter1&action=parameter2 

All you have to write is the next code in the ".htaccess" file. Then, you must paste that file in the two locations given.
```js
Options All -Indexes

<IfModule mod_rewrite.c>
# Activar rewrite
RewriteEngine on

RewriteCond %{SCRIPT_FILENAME} !-d
RewriteCond %{SCRIPT_FILENAME} !-f


</IfModule>
```



