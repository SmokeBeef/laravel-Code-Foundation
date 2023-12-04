<?php

namespace App\Services;

use App\Repositories\ItemRepository;


class ItemService
{
    protected $itemRepository;
    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function getAllPagination(int $offset = 0, int $limit = 10)
    {
        $items = $this->itemRepository->getAllPagination($offset, $limit);
        return $items;
    }

    public function total()
    {
        $items = $this->itemRepository->total();
        return $items;
    }
}