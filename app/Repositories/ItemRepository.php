<?php

namespace App\Repositories;

use App\Models\Item;

class ItemRepository
{
    protected $item;
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function getAllPagination(int $offset, int $limit)
    {
        return $this->item::limit($limit)->offset($offset)->get();
    }

    public function total()
    {
        return $this->item::count();
    }
    
}