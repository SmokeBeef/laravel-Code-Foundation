<?php 

namespace App\Services\Resepsionis;

use App\Repositories\Resepsionis\ItemRepository;

class ItemService
{
    protected $item;
    public function __construct(ItemRepository $item)
    {
        $this->item = $item;
    }

    public function createOne($data)
    {
        $item = $this->item->createOne($data);
        return $item;
    }
}