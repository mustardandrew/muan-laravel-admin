<?php

namespace Muan\Admin\Services;

/**
 * Class FlashMessage
 *
 * @package Muan\Admin\Services
 */
class FlashMessageService
{

    /**
     * Send message
     *
     * @param string $message
     * @param string $level
     */
    public function message(string $message, string $level = 'default')
    {
        session()->flash('flash_message', $message);
        session()->flash('flash_message_level', $level);
    }

    /**
     * Send error
     *
     * @param string $message
     */
    public function error(string $message)
    {
        $this->message($message, 'error');
    }

    /**
     * Send warning
     *
     * @param string $message
     */
    public function warning(string $message)
    {
        $this->message($message, 'warning');
    }

    /**
     * Send notice
     *
     * @param string $message
     */
    public function notice(string $message)
    {
        $this->message($message, 'notice');
    }

    /**
     * Has message
     *
     * @return bool
     */
    public function hasMessage()
    {
        return session()->has('flash_message');
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return  session('flash_message');
    }

    /**
     * Get level
     *
     * @return string
     */
    public function getLevel()
    {
        return session('flash_message_level');
    }

}
