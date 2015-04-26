<?php

namespace Anax\Flash;

/**
 * Testing CFlashAnax - for sending messages..
 *
 */
class CFlashAnaxTest extends \PHPUnit_Framework_TestCase
{


    /**
     * Test of the construct method
     *
     * @return void
     *
     */

    public function testSessionCreate() 
    {
    
   // construct should set $_SESSION['flashMessages' to empty array if it's NOT already set}
        $flashMessageObject = new CFlashSimple;
        
        $sessionVariable = $_SESSION['flashMessages'];
        
        $expected = array();
        
        $this->assertEquals($sessionVariable, $expected, 'Session variable not empty array');
            
    // If something is stored in the session variable (or it is just set), it should NOT be erased by the construct method.
        
        unset($flashMessageObject);
            // expected value and session variable is given the same test value
        $expected = $_SESSION['flashMessages'] = array("message" => 'test', "type" => 'test');
            // make construct method run
        $flashMessageObject = new CFlashSimple;
            // see if session variable has been erased or not. (it should not have been)
        $sessionVariable = $_SESSION['flashMessages'];
        
        $this->assertEquals($expected, $sessionVariable, 'Session variable not keeping saved value');
        
        
        
    }
    
    
   /**
     * Test of the setMessage method - with valid data
     *
     * @return void
     *
     */

    public function testSetMessage() 
    {

       
       $flashMessageObject = new CFlashSimple;
       
       $flashMessageObject->setMessage('testMessage', 'notice');
       
       $expected[] =  array("message" => 'testMessage', "type" => 'notice');
       
       $message = $_SESSION['flashMessages'];
       
       $this->assertEquals($expected, $message, 'saved values NOT the same as entered values');
       
    }
    
    /**
     * Test of the getMessage method - with valid data. Should unset session variable
     *
     * @return void
     *
     */

    public function testGetMessage() 
    {
            
       $flashMessageObject = new CFlashSimple;
       
       $flashMessageObject->setMessage('testMessage', 'notice');
       
       // getting the messages should unset the session variable
       $flashMessageObject->getMessage();
       
       $expected = FALSE;
       $status = isset($_SESSION['flashMessages']) ? TRUE : FALSE;
               
       $this->assertEquals($expected, $status, 'Session variable NOT unset after getMessage() was called');
    }
    
    
    /**
     * Test the getMessage method - with invalid message type. Should throw Exception
     *
     * @expectedException              Exception
     * @return void
     *
     */

    public function testInvalidMessageTypeException() 
    {
         $flashMessageObject = new CFlashSimple;
            // 'invalid' is an invalid message type
         $flashMessageObject->setMessage('testMessage', 'invalid');
         
         // see above:  @expectedException     Exception  
         
         
         
    }







}