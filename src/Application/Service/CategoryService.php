<?php

namespace App\Application\Service;


use App\Application\DTO\CategoryAssembler;
use App\Application\DTO\CategoryDTO;
use App\Domain\Model\Category\Category;
use App\Domain\Model\Category\CategoryRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class CategoryService
 * @package App\Application\Service
 */
final class CategoryService
{

    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * @var CategoryAssembler
     */
    private $categoryAssembler;

    /**
     * CategoryService constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CategoryAssembler $categoryAssembler
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        CategoryAssembler $categoryAssembler
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->categoryAssembler = $categoryAssembler;
    }

    /**
     * @param int $categoryId
     * @return Category
     * @throws EntityNotFoundException
     */
    public function getCategory(int $categoryId): Category
    {
        $category = $this->categoryRepository->findById($categoryId);
        if (!$category) {
            throw new EntityNotFoundException('Category with id '.$categoryId.' does not exist!');
        }
        return $category;
    }

    /**
     * @return array|null
     */
    public function getAllCategorys(): ?array
    {
        return $this->categoryRepository->findAll();
    }

    /**
     * @param CategoryDTO $categoryDTO
     * @return Category
     */
    public function addCategory(CategoryDTO $categoryDTO): Category
    {
        $category = $this->categoryAssembler->createCategory($categoryDTO);
        $this->categoryRepository->save($category);

        return $category;
    }

    /**
     * @param int $categoryId
     * @param CategoryDTO $categoryDTO
     * @return Category
     * @throws EntityNotFoundException
     */
    public function updateCategory(int $categoryId, CategoryDTO $categoryDTO): Category
    {
        $category = $this->categoryRepository->findById($categoryId);
        if (!$category) {
            throw new EntityNotFoundException('Category with id '.$categoryId.' does not exist!');
        }
        $category = $this->categoryAssembler->updateCategory($category, $categoryDTO);
        $this->categoryRepository->save($category);

        return $category;
    }

    /**
     * @param int $categoryId
     * @throws EntityNotFoundException
     */
    public function deleteCategory(int $categoryId): void
    {
        $category = $this->categoryRepository->findById($categoryId);
        if (!$category) {
            throw new EntityNotFoundException('Category with id '.$categoryId.' does not exist!');
        }

        $this->categoryRepository->delete($category);
    }

}
