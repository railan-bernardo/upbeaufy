<?php

namespace Source\Models;

use Source\Core\Model;

class PageHome extends Model{

    public function __construct()
    {
        parent::__construct("home", ["id"], ["title", "subtitle", "content", "description"]);
    }

        /**
     * @param string $id
     * @param string $columns
     * @return null|PageHome
     */
    public function findByHomeId(string $id, string $columns = "*"): ?PageHome
    {
        $find = $this->find("id = :id", "id={$id}", $columns);
        return $find->fetch();
    }


    /**
     * @return bool
     */
    public function save(): bool
    {
        return parent::save();
    }

}

?>