<?php namespace Jakjr\Messenger;

use Config;
use Session;

/**
 * @author João Alfredo Knopik Junior
 */
class Messenger
{
    const SessionKey = 'jakjr.messages';

    /**
     * @param $message
     * @param bool $status
     * Define uma mensagem para ser exibida
     */
    public function set($message, $status)
    {
        Session::push(self::SessionKey, new Message($message, $status));
    }

    /**
     * @return string
     * Retorna uma mensagem armazenada para exibição
     */
    public function get()
    {
        if (! $this->has()) {
            return false;
        }

        $messages = Session::get(self::SessionKey);
        Session::forget(self::SessionKey);
        return $messages;
    }

    /**
     * @return bool
     * Retorna um boolean representando a existencia de uma mensagem para ser exibida
     */
    public function has()
    {
        return Session::has(self::SessionKey);
    }

    public function success($message)
    {
        $this->set($message, Config::get('messenger::success-class'));
    }

    public function info($message)
    {
        $this->set($message, Config::get('messenger::info-class'));
    }

    public function warn($message)
    {
        $this->set($message, Config::get('messenger::warn-class'));
    }

    public function error($message)
    {
        $this->set($message, Config::get('messenger::error-class'));
    }


}