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
    public function updateOne($id, $data)
    {
        $item = $this->item->updateOne($id, $data);
        return $item;
    }
    public function deleteOne($id)
    {
        $item = $this->item->deleteOne($id);
        return $item;
    }
}