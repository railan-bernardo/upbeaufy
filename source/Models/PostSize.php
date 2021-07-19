<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Service
 * @package Source\Models
 */
class PostSize extends Model
{
    /**
     * Post constructor.
     */
    public function __construct()
    {
        parent::__construct("size", ["id"], ["idpost", "color", "weight", "persons"]);
    }



    /**
     * @return bool
     */
    public function save(): bool
    {

        return parent::save();
    }
}