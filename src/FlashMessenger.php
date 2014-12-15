<?php
/**
 * FlashMessage
 *
 * Create and persist message in the session.
 * @version 1.0
 * @author muneer<muneer@live.it> 
 */

namespace Com\Encodez;

class FlashMessenger 
{
    const ERROR = 1; 	// Message type ERROR
    const SUCCESS = 2; 	// Message type SUCCESS
    const INFO = 3; 	// Message type INFO
    const WARNING = 4; 	// Message type WARNING

    /**
     * Check if there are messages available
     *
     * @var $type string Message type
     * @return bool
     */
    public static function HasMessages($type = NULL)
    {
        if ($type == NULL) {
            if (isset($_SESSION['flash_message_' . FlashMessage::ERROR])
                || isset($_SESSION['flash_message_' . FlashMessage::SUCCESS])
                || isset($_SESSION['flash_message_' . FlashMessage::INFO]))
            {
                return TRUE;
            }
        }
        else {
            if (isset($_SESSION['flash_message_' . $type])) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * Add message to the storage
     *
     * @var $message string Message text
     * @var $type string Message type
     */
    public static function Add($message, $type = FlashMessage::INFO)
    {		
        if (!isset($_SESSION['flash_message_' . $type]))
        $_SESSION['flash_message_' . $type] = array();	 

        if (is_array($message))
            $_SESSION['flash_message_' . $type] = array_merge($_SESSION['flash_message_' . $type], $message);
        else
            $_SESSION['flash_message_' . $type][] = $message;        
    }

    /**
     * Get message by type
     * 
     * @var $type string Message type
     * @var $unset bool Whether message should be removed from storage after retrival
     * @return array|mixed
     */
    public static function Get($type, $unset = TRUE)
    {
        if (isset($_SESSION['flash_message_' . $type]))
        {
            $message =  $_SESSION['flash_message_' . $type];
            if ($unset)
                unset($_SESSION['flash_message_' . $type]);
            return $message;
        }
        else
        {
            return array();
        }
	}
}