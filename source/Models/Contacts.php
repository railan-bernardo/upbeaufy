<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Service
 * @package Source\Models
 */
class Contacts extends Model
{
    /**
     * Post constructor.
     */
    public function __construct()
    {
        parent::__construct("contact", ["id"], ["first_name", "email",  "phone", "last_name", "msg"]);
    }




    /**
     * @return bool
     */
    public function save(): bool
    {

 return parent::save();
    }
}