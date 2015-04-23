<?php

/**
 * Config file for pagecontrollers, creating an instance of $app.
 *
 */

// Get environment & autoloader.
require __DIR__.'/config.php'; 

// Create services and inject into the app. 

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

                
   $app->theme->setTitle("Flash-redirect");
   
  
    //Make a full HTTP redirection to new page/route -- see below
    //$app->response->redirect("flash-redirect");
    
    
    
   // get messages from session in HTML format. ready to use in a view.
   $messages = $app->flashMessages->getMessage();
    
       $app->views->add('default/article', [
        'content' => $messages,   
    ]);


// add stylesheet for styling messages 
$app->theme->addStylesheet('css/flash.css');

$app->theme->render();