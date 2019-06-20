<?php

namespace App\Infrastructure\Http\Rest\Controller;


use App\Application\DTO\CategoryDTO;
use App\Application\Service\CategoryService;
use App\Domain\Model\Category\Category;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoryController
 * @package App\Infrastructure\Http\Rest\Controller
 */
final class CategoryController extends FOSRestController
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Creates an Category resource
     * @Rest\Post("/categorys")
     * @ParamConverter("categoryDTO", converter="fos_rest.request_body")
     * @param CategoryDTO $categoryDTO
     * @return View
     */
    public function postCategory(CategoryDTO $categoryDTO): View
    {
        $category = $this->categoryService->addCategory($categoryDTO);

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($category, Response::HTTP_CREATED);
    }

    /**
     * Retrieves an Category resource
     * @Rest\Get("/categorys/{categoryId}")
     * @param int $categoryId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getCategory(int $categoryId): View
    {
        $category = $this->categoryService->getCategory($categoryId);

        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($category, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Category resource
     * @Rest\Get("/categorys")
     * @return View
     */
    public function getCategorys(): View
    {
        $categorys = $this->categoryService->getAllCategorys();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of category object
        return View::create($categorys, Response::HTTP_OK);
    }

    /**
     * Replaces Category resource
     * @Rest\Put("/categorys/{id}")
     * @ParamConverter("categoryDTO", converter="fos_rest.request_body")
     * @param int $categoryId
     * @param CategoryDTO $categoryDTO
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function putCategory(int $categoryId, CategoryDTO $categoryDTO): View
    {
        $category = $this->categoryService->updateCategory($categoryId, $categoryDTO);

        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($category, Response::HTTP_OK);
    }

    /**
     * Removes the Category resource
     * @Rest\Delete("/categorys/{categoryId}")
     * @param int $categoryId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteCategory(int $categoryId): View
    {
        $this->categoryService->deleteCategory($categoryId);

        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
