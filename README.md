# **Professional Blog - Marc Lassort**

This blog is the 5th project of the OpenClassrooms PHP/Symfony Web Developer training.  
It has mostly been developed in PHP with a Twig template engine. 

# **How to install the blog**

## **Pre-Requisites**

* **Database**: MySQL 
* **PHP version**: >=7.4
* **Softwares**: 
- __NPM__: `npm install`
- __Composer__: `composer install`

## **Installation**

1. Download or clone the GitHub repository.
2. Run `composer install`. 
3. Make the following configuration settings. 

## **Mail configuration**

To configurate the mail, you have to edit the file `mailConfigSample.json` as such: 

1. First, rename it `mailConfig.json`.
2. Then, fill in all the information for the mail configuration: host, username, password, port, the sending and the reply email addresses.  

## **Database configuration**

To configurate the database, first you have to import a file called `blog_marc_lassort.sql` (in the folder `diagrams`) into MySQL.

Then you have to edit the file `configSample.json` as such:

1. First, rename it `config.json`.
2. Then, fill in all the information for the database configuration: 
    1. A nickname for your database (it is the least important)
    2. Its precise name (in this case `blog_marc_lassort`)
    3. The server (i.e `localhost`)
    4. The host (i.e `127.0.0.1`)
    5. The user login (i.e `root`)
    6. Its password (i.e `root`)

## **External librairies**

- __SimpleRouter__: allows to handle routes 
- __Twig__: it is our template engine 
- __TinyMCE__: allows to manage good-looking textareas 
- __PhpMailer__: manages emails
- __Slugify__: allows to use slugs for posts 

**NOW you can run the site!**

## **Code checking**

- __CodeClimate__: https://codeclimate.com/github/marclassort/Blog-PHP-Marc-Lassort 
- __SonarCloud__: https://sonarcloud.io/project/overview?id=marclassort_Blog-PHP-Marc-Lassort