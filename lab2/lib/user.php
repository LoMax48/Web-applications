<?php

class User
{
    private $name;
    private $login;
    private $password;
    private $cookieFlag;

    function __construct($nameParam, $loginParam, $passParam, $cookieParam)
    {
        $this->name = $nameParam;
        $this->login = $loginParam;
        $this->password = $passParam;
        $this->cookieFlag = $cookieParam;
    }

    function getName() { return $this->name; }
    function getLogin() { return $this->login; }
    function getPassword() { return $this->password; }
    function getCookieFlag() { return $this->cookieFlag; }
}