<?php

namespace App\Repositories\Resepsionis;
use App\Models\Item;

class ItemRepository
{
    protected $itemModel;
    public function __construct(Item $itemModel)
    {
        $this->itemModel = $itemModel;
    }

    public function createOne($data)
    {
        $item = $this->itemModel::create($data);
        return $item;
    }
    public function updateOne($id, $data)
    {
        $item = $this->itemModel::find($id);
        $item->update($data);
        return $item;
    }
    public function deleteOne($id)
    {
        $item = $this->itemModel::find($id);
        $item->delete();
        return $item;
    }
}