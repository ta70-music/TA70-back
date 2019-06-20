<?php

namespace App\Domain\Model\Category;

/**
 * Interface CategoryRepositoryInterface
 * @package App\Domain\Model\Category
 */
interface CategoryRepositoryInterface
{

    /**
     * @param int $categoryId
     * @return Category
     */
    public function findById(int $categoryId): ?Category;

    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param Category $category
     */
    public function save(Category $category): void;

    /**
     * @param Category $category
     */
    public function delete(Category $category): void;

}
