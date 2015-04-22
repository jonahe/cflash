<?php

namespace Anax\Flash;

/**
 * Store messages for flashing them to the user as user feedback.
 *
 */
class CFlash implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * The message 
     * The string that will be shown to the user as feedback
     * @var string
     */
    protected $message;
    
    /**
     * The message type (error, success, notice)
     * The flag that decides the styling of the output.
     * @var string
     */
     protected $type;
     
    /**
     * The (html) class attribute for output message (error, success, notice)
     * Class attributes that allow for different css-styling depending on message type
     * @var array() Array with pairs (flag => class), eg. 'notice' => 'message notice'.  
     */
     protected $class = array(  'error'   => 'alert alert-error',
                                'success' => 'alert alert-success',
                                'notice'  => 'alert alert-info',
                                );
    



   /**
     * Set a message.
     *
     * @param string a message.
     * @param string a flag to decide what type of message it is (error, success, notice).
     *     
     * @return void
     */
    public function setMessage($message, $flag = null)
    {
        $this->message = $message;
        
        // use flag to decide message type. Assume "notice" as default.
        
        switch($flag){
        
        case "error": $this->type = $flag;
                break;
        case "success": $this->type = $flag;
                break;
        default: $this->type = "notice";
                break;
        
        }
    }
    
    
    /**
     * Save message in session.
     * Uses the session service that Anax MVC provides. Saves message for later retrieval.
     *
     * @param array Options to configure the session, eg. a session name.
     * @return void
     */
   public function saveInSession($options = []){
   
   // can't save if no message exists
   if(!$this->message){
           die("No message available to save. Set message, by using method setMessage, before saving in session.");       
   }
   
   // make array with values to save.
   $values = array('message' => $this->message, 'type' => $this->type);
   // set key and value in session. for later retrieval
   $this->session->set('flashMessage', $values);
  
   }



   /**
     * Get the message, as HTML DIV
     * Get output as HTML div element, with class attribute ready to style with CSS.
     *
     * @return string HTML code for message, or null - if no message was found
     *
     */
    public function getMessage()
    {
        $message    = isset($this->message) ? $this->message : $this->getSessionMessage();
        $type    = isset($this->type) ? $this->type : $this->getSessionMessageType();
        
        
        
        
        if($message && $type){
                // pick relevant class attribute from array.
                $class      = $this->class[$type];
                
                $html = "<div class='$class'>$message</div>";
                return $html;
        }
        else{
                return null;
        }
    }
    
    /**
     * Get the message from session
     * 
     * @return string Message, or null if not exists
     *
     */
     public function getSessionMessage(){
             
             return $this->session->get('flashMessage')['message'];
     }
     
    /**
     * Get the message type from session
     * 
     * @return string Type of message, or null if not exists
     *
     */
     public function getSessionMessageType(){
             
             return $this->session->get('flashMessage')['type'];
     }
}
