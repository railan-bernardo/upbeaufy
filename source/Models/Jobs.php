<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Jobs
 * @package Source\Models
 */
class Jobs extends Model
{
    /**
     * Post constructor.
     */
    public function __construct()
    {
        parent::__construct("work", ["id"], ["first_name", "email", "address", "zipcode", "state", "city", "msg"]);
    }


    /**
     * @return bool
     */
    public function save(): bool
    {
        return parent::save();
    }
}