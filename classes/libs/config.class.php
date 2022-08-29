<?php

class Config {

    protected $origin = "localhost";

    protected $REACT_APP_KEY = "password123456";

    protected function CookieOptions() {

        return [
            'expires' => time() + (120*60),
            'path' => '/initialauthorization',
            'domain' => $this->origin,
            'secure' => false,
            'httponly' => true,
            'samesite' => 'strict',
        ];
    }
}