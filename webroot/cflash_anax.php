<?php

/**
 * Config file for pagecontrollers, creating an instance of $app.
 *
 */

// Get environment & autoloader.
require __DIR__.'/config.php'; 

// Create services and inject into the app.  the session is created by default

// dependency injector factory
$di  = new \Anax\DI\CDIFactoryDefault;


// create application
$app = new \Anax\MVC\CApplicationBasic($di);


// setup service for flashMessages

$di->set('flashMessages', function() use ($di) {
     $flashMessages = new Anax\Flash\CFlashAnax();
     $flashMessages->setDI($di);
     return $flashMessages;
}); 

                
   $app->theme->setTitle("Flash");
   
   // set the flash messages (and their types) you want to show later
   $app->flashMessages->setMessage("Test av success!", "success");
   $app->flashMessages->setMessage("Test av notice!", "notice");
   $app->flashMessages->setMessage("Test av error!", "error");
   // they are automatically stored in session.
  
    //Make a full HTTP redirection to new page
    $app->response->redirect("flash_simple_redirect.php");
    


$app->theme->render();