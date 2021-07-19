<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class Service
 * @package Source\Models
 */
class Products extends Model
{
    /**
     * Post constructor.
     */
    public function __construct()
    {
        parent::__construct("services", ["id"], ["title", "uri", "subtitle", "content", "specification", "structure"]);
    }

    /**
     * @param null|string $terms
     * @param null|string $params
     * @param string $columns
     * @return mixed|Model
     */
    public function findPost(?string $terms = null, ?string $params = null, string $columns = "*")
    {
        $terms = "status = :status AND post_at <= NOW()" . ($terms ? " AND {$terms}" : "");
        $params = "status=post" . ($params ? "&{$params}" : "");

        return parent::find($terms, $params, $columns);
    }

    /**
     * @param string $uri
     * @param string $columns
     * @return null|Products
     */
    public function findByUri(string $uri, string $columns = "*"): ?Products
    {
        $find = $this->find("uri = :uri", "uri={$uri}", $columns);
        return $find->fetch();
    }


    /**
     * @return null|ServiceCategory
     */
    public function category(): ?ServiceCategory
    {
        if ($this->category) {
            return (new ServiceCategory())->findById($this->category);
        }
        return null;
    }

    /**
     * @return null|Subcategory
     */
    public function subcategory(): ?Subcategory
    {
        if ($this->subcategory) {
            return (new Subcategory())->findById($this->subcategory);
        }
        return null;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        $checkUri = (new Products())->find("uri = :uri AND id != :id", "uri={$this->uri}&id={$this->id}");

        if ($checkUri->count()) {
            $this->uri = "{$this->uri}-{$this->lastId()}";
        }

        return parent::save();
    }
}