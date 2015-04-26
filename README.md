CFlashAnax
==========
PHP class for sending/recieving flash messages (notices, errors etc.) through use of a session. 

Installation
============

To get started, follow these steps after installing CFlash through Composer. 

* Step 1. In your vendor/jonahe/cflash/webroot folder, locate the two files (cflash_anax.php, cflash_anax_redirect.php) and copy them to your own webroot folder. These files show how to use CFlashAnax.

* Step 2. In your vendor/jonahe/cflash/src/Flash folder, locate the class file (CFlashAnax.php) and copy it to your Anax/src/Flash folder.

* Step 3. In your vendor/jonahe/cflash/webroot/css folder, locate the css file (flash.css) and copy it to your webroot/css folder.

* Step 4. Point your webbrowser to cflash_anax.php. It should set three test messages through the use of CFlashAnax, then do a redirect to the file cflash_anax_redirect.php where the messages will be shown.


Note that CFlashAnax makes use of Anax MVC's CSession (session handler). This service is automatically available to CFlashAnax through dependency injection.


For a simpler version, not dependent on the Anax framework or CSession: Use the class CFlashSimple instead. The API/interface to this class is the same as with CFlashAnax.

Exampel code of this approach is found in cflash_simple.php




[![Build Status](https://travis-ci.org/jonahe/cflash.svg?branch=master)](https://travis-ci.org/jonahe/cflash)