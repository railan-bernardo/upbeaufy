<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Jobs
 * @package Source\Models
 */
class Budget extends Model
{
    /**
     * Post constructor.
     */
    public function __construct()
    {
        parent::__construct("budget", ["id"], ["juridic", "first_name", "email", "telephone", "phone", "state", "city", "address", "zipcode", "company", "items", "msg"]);
    }




    /**
     * @return bool
     */
    public function save(): bool
    {
        return parent::save();
    }
}