<?php

namespace Model;

class Admin extends ActiveRecord {
    // DB
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id = $args['email'] ?? '';
        $this->id = $args['password'] ?? '';
    }
}