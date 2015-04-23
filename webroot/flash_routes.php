<?php

$app->router->add('flash', function() use ($app) {
                
   $app->theme->setTitle("Flash");
   
   // set the flash messages (and their types) you want to show later
   $app->flashMessages->setMessage("Test av success!", "success");
   $app->flashMessages->setMessage("Test av notice!", "notice");
   $app->flashMessages->setMessage("Test av error!", "error");
   // they are automatically stored in session.
  
    //Make a full HTTP redirection to new page/route -- see below
    $app->response->redirect("flash-redirect");

});


$app->router->add('flash-redirect', function() use ($app) {
   
   $app->theme->setTitle("FlashRedirect");
   
   // get messages from session in HTML format. ready to use in a view.
   $messages = $app->flashMessages->getMessage();
   
   // this assumes you have this template in your view/me/ folder. You could do an echo too.
   $app->views->add('me/page', [
        'content' => $messages,   
    ]);
   
});