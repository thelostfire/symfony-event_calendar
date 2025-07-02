<?php

namespace App\Services;

use App\Repository\CategoryRepository;


class FindAllCategoryRepo {

    public function __construct(private CategoryRepository $categRepo) {
        
    }
    public function findAll(): Array
    {
        return $this->categRepo->findAll();
    }
}