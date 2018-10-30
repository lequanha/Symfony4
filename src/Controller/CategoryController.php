<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Form\CategoryType;

class CategoryController extends ApiController
{
    /**
     * @Route("/category/all")
     * @Method("GET")
     */
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->transformAll();

        return $this->respond($categories);
    }
    /**
     * @Route("/category/new")
     * @Method("POST")
     */
    public function postCategoryAction(Request $request, CategoryRepository $categoryRepository, EntityManagerInterface $em)
    {
        $request = $this->transformJsonBody($request);

        if (! $request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        // persist the new category 
        $category = new Category;
        $category->setName($request->get('name'));

        $em->persist($category);
        $em->flush();

        return $this->respondCreated($categoryRepository->transform($category));
    }
}

?>

