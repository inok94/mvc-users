<?php

namespace App\src\core;

use App\src\lib\Db;
abstract class Model {
    public $db;

    public function __construct() {
        $this->db = new Db;
    }
}