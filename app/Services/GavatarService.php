<?php

namespace Muan\Admin\Services;

/**
 * Class GavatarService
 *
 * @package Muan\Admin\Services
 */
class GavatarService
{

    /**
     * Get image url
     *
     * @param string $email
     * @param int $size
     * @return string
     */
    public function url($email, $size = 250)
    {
        $hashEmail = md5(strtolower($email));

        return "https://secure.gravatar.com/avatar/{$hashEmail}?d=mm&s={$size}";
    }

}
