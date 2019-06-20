<?php


namespace App\Application\DTO;


use App\Domain\Model\Category\Category;

/**
 * Class CategoryAssembler
 * @package App\Application\DTO
 */
final class CategoryAssembler
{

    /**
     * @param CategoryDTO $categoryDTO
     * @param Category|null $category
     * @return Category
     */
    public function readDTO(CategoryDTO $categoryDTO, ?Category $category = null): Category
    {
        if (!$category) {
            $category = new Category();
        }

        $category->setContent($categoryDTO->getContent());
        $category->setTitle($categoryDTO->getTitle());

        return $category;
    }

    /**
     * @param Category $category
     * @param CategoryDTO $categoryDTO
     * @return Category
     */
    public function updateCategory(Category $category, CategoryDTO $categoryDTO): Category
    {
        return $this->readDTO($categoryDTO, $category);
    }

    /**
     * @param CategoryDTO $categoryDTO
     * @return Category
     */
    public function createCategory(CategoryDTO $categoryDTO): Category
    {
        return $this->readDTO($categoryDTO);
    }

    /**
     * @param Category $category
     * @return CategoryDTO
     */
    public function writeDTO(Category $category)
    {
        return new CategoryDTO(
            $category->getTitle(),
            $category->getContent()
        );
    }

}
