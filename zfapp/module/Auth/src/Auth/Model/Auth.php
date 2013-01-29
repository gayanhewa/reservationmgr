<?php
namespace Auth\Model;

class Auth
{
    public $id;
    public $username;
    public $password;
    public $lastlogin;

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->password  = (isset($data['password'])) ? $data['password'] : null;
        $this->lastlogin  = (isset($data['lastlogin'])) ? $data['lastlogin'] : null;
    }
}
