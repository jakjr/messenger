<?php
namespace Jakjr\Messenger;

use Illuminate\Support\Facades\Facade;

class MessengerFacade extends Facade
{
    protected static function getFacadeAccessor() {
        return 'messenger';
    }
}