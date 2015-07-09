<?php
namespace Jakjr\Messenger;

use Config;

class Message {

    private $message;
    private $statusClass;

    function __construct($message, $statusClass)
    {
        $this->message = $message;
        $this->statusClass = $statusClass;
    }

    public function display()
    {
        $wrapper = Config::get('messenger::wrapper');

        $wrapperStatusClass = str_replace(':status-class:', $this->statusClass, $wrapper);
        $wrapperMessage = str_replace(':message:', $this->message, $wrapperStatusClass);

        return $wrapperMessage;
    }

}