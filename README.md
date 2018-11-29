# Bulletin Board

This is a simple tool that allows users to remotely add messages to a bulletin board, which are then displayed in a common area (eg. a TV in a break room, or on the wall in a walkway, etc.). The messages are added, deleted, and displayed with a web interface. Basically the idea is that you navigate to the bulletinboard.php web page on the display TV, disable sleep mode on the PC, make the browser full screen and just let it run. The messages are displayed on loop, and updated in real time (once per complete loop).

## Getting Started

There is no installer available, so you'll need to set this project up manually to use it. See: "Installing" section.

### Prerequisites

You'll need to understand how to get a basic LAMP stack web application running (install and configure Apache, make a MySQL database and table, etc.) in order to use this project.

It was developed and tested in the following environment:

Ubuntu 16.04 LTS
Apache 2.4.18
PHP 7.0.32
MySQL 14.14

### Installing

1. Copy all files from this repo into your Apache (or other web server) root directory

2. Make a MySQL databased called "bulletin"
  eg: CREATE DATABASE bulletin;
  
3. Make a table in the "bulletin" database called "messages" using the following command. (your table must use these fields, or the system will not work. Unless you modify the code to display/add/delete messages)
  
  CREATE TABLE messages(
   msg_id INT NOT NULL AUTO_INCREMENT,
   creator VARCHAR(40) NOT NULL,
   date_created DATE,
   display_until DATE,
   message VARCHAR(1000) NOT NULL,
   PRIMARY KEY ( msg_id )
   )
  
4. Make a MySQL user called "bulletin" and give the user full permissions on the "messages" table, and flush the privileges.
  eg: 
  CREATE USER 'bulletin'@'localhost' IDENTIFIED BY 'password';
  GRANT ALL PRIVILEGES ON bulletin.messages TO 'bulletin'@'localhost';
  
  *make sure to change password to a real password

5. Take your newly created password, and enter it into the source code so it can query the database. There are 3 files that you'll need to add your password to:
  -index.php
  -submitNewMessage.php
  -deleteMessage.php
  
  In each of those files there is a line that looks like this:
  $password = "password";
  
  Change the password in quotes to your real password that you created in step 4.

## And that's it!

You should be able to go to your website now via the URL you defined in the Apache config.


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
You're welcome to use this for any purpose. No need to ask me. Please include an acknowledgement to me in your documentation.

## Acknowledgments

Animations thanks to Justin Aguilar:
 www.justinaguilar.com/animations/
 
Additional CSS styling thanks to Daniel Eden:
  http://daneden.me/animate
