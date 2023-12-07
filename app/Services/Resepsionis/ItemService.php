<?php

namespace App\Services\Resepsionis;

use App\Repositories\Resepsionis\ItemRepository;

class ItemService
{
    protected $itemRepository;
    public function __construct(ItemRepository $item)
    {
        $this->itemRepository = $item;
    }

    public function createOne($data)
    {
        $item = $this->itemRepository->createOne($data);
        return $item;
    }
    public function updateOne($id, $data)
    {
        $findItem = $this->itemRepository->findbyId($id);
        if (empty($findItem)) {
            return null;
        }
        $item = $this->itemRepository->updateOne($id, $data);
        return $item;
    }
    public function deleteOne($id)
    {
        $findItem = $this->itemRepository->findbyId($id);
        if (empty($findItem)) {
            return null;
        }
        $item = $this->itemRepository->deleteOne($id);
        return $item;
    }
}