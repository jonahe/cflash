<?php 

// this is php example code of how to use CFlashSimple


   // create flash message object.
   $flash = new \Anax\Flash\CFlashSimple;
   
   // set flash message to show (later)  -- these are saved in the session
   $flash->setMessage("Test av success!", "success");
   $flash->setMessage("Test av notice!", "notice");
   $flash->setMessage("Test av error!", "error");
   
   // get messages - messages can now be shown which ever way you want.
   $messagesAsHTML = $flash->getMessage();
   
   //  echo $messagesAsHTML, or what ever you want to do with the messages.


?>