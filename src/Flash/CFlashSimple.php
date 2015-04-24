<?php

namespace Anax\Flash;

/**
 * Store messages for flashing them to the user as user feedback.
 *
 */
class CFlashSimple
{

     
    /**
     * Valid types of messages and their class attribute name (error, success, notice)
     * Class attributes that allow for different css-styling depending on message type
     * @var array() Array with pairs (type => class), eg. 'notice' => 'message notice'.  
     */
     protected $class = array(  'error'   => 'alert alert-error',
                                'success' => 'alert alert-success',
                                'notice'  => 'alert alert-info',
                                );
    

    /**
     *  Constructor that initializes session flash variable
     *
     * @return void
     */
      
    public function __construct()
	{
		if(!isset($_SESSION['flashMessages'])) {
			$_SESSION['flashMessages'] = array();
		}
	} 
     
     
     
     

   /**
     * Set a message - by saving to session variable
     *
     * @param string a message.
     * @param string type of message (error, success, notice).
     *     
     * @return void
     */
    public function setMessage($message, $type = 'notice')
    {
        
        // abort if $flag is invalid
        if(!array_key_exists($type, $this->class)){
                        die("'$type' is not a valid message type");
        }
        
        // make array with message and type
        $message = array("message" => htmlentities($message), "type" => $type);
        
        // save to session array.
        
        $_SESSION['flashMessages'][] = $message;
        
    }
    



   /**
     * Get the messages from session - output as HTML DIV
     * Get output as HTML div element, with class attribute ready to style with CSS.
     *
     * @return string HTML code for message, or null - if no message was found
     *
     */
    public function getMessage()
    {
        $messages = isset($_SESSION['flashMessages']) ? $_SESSION['flashMessages'] : null;
        
        if(!empty($messages)){
                $html = "";
                foreach($messages as $msg){
                // match type with class
                    $class = $this->class[$msg['type']];
                    $message = $msg['message'];
                    $html .= "<div class='$class'><p>$message</p></div>";
                }
        // unset session variable
        unset($_SESSION['flashMessages']);
        return $html;
        }
        else{
        return null;
        }
    }
    

}
