<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\Parameter;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Form\ProductType;

use App\Entity\User;
use App\Repository\UserRepository;

class ProductController extends ApiController
{
    private function userAuthorization(Request $request, EntityManagerInterface $em)
    {  
        if (! $request->get('username')) {
            return false;
        }
        if (! $request->get('password')) { // the password is here simply as the email
            return false;
        }

        $user = $request->get('username');
        $password = $request->get('password');

        $qb = $em->createQueryBuilder()
                 ->select('u')
                 ->from(User::class, 'u')
                 ->where('u.name = :user_name AND u.email = :user_email')
                 ->setParameters(array( 'user_name' => $user, 'user_email' => $password ) );
        $qResult = $qb->getQuery()->execute();
        return ( count($qResult) > 0 );
    }
    /**
     * @Route("/product/all")
     * @Method("GET")
     */
    public function index(ProductRepository $productRepository)
    {
        $products = $productRepository->transformAll();

        return $this->respond($products);
    }
    /**
     * @Route("/product/entry/{id}")
     * @Method("GET")
     */
    public function getProductAction(int $id, ProductRepository $productRepository): ?object
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        $product = $productRepository->find($id);
        if (! $product) {
            return $this->respondNotFound();
        }

        $product = $productRepository->transform($product);

        return $this->respond($product);
    }
    /**
     * @Route("/product/new")
     * @Method("POST")
     */
    public function postProductAction(Request $request, ProductRepository $productRepository, EntityManagerInterface $em)
    {
        $request = $this->transformJsonBody($request);

        if (! $request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        if (! $this->userAuthorization($request, $em) ) {
           return $this->respondUnauthorized();
        }


        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }
        if (! $request->get('category')) {
            return $this->respondValidationError('Please provide a category!');
        }
        if (! $request->get('sku')) {
            return $this->respondValidationError('Please provide a sku!');
        }
        if (! $request->get('price')) {
            return $this->respondValidationError('Please provide a price!');
        }
        if (! $request->get('quantity')) {
            return $this->respondValidationError('Please provide a quantity!');
        }

        // persist the new product
        $product = new Product;
        $product->setName($request->get('name'));
        $product->setCategory($request->get('category'));
        $product->setSku($request->get('sku'));
        $product->setPrice($request->get('price'));
        $product->setQuantity($request->get('quantity'));

        $em->persist($product);
        $em->flush();

        return $this->respondCreated($productRepository->transform($product));
    }
    /**
     * @Route("/product/update")
     * @Method("PUT")
     */
    public function updateProductAction(Request $request, ProductRepository $productRepository, EntityManagerInterface $em)
    {
        $request = $this->transformJsonBody($request);

        if (! $request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        if (! $this->userAuthorization($request, $em) ) {
           return $this->respondUnauthorized();
        }

        if (! $request->get('id')) {
            return $this->respondValidationError('Please provide an id!');
        }
        $id = $request->get('id');
        $product = $productRepository->find($id);
        if (! $product) {
            return $this->respondNotFound();
        }
      
        if ($request->get('name')) {
            $product->setName($request->get('name'));
        }
        if ($request->get('category')) {
            $product->setCategory($request->get('category'));
        }
        if ($request->get('sku')) {
            $product->setSku($request->get('sku'));
        }
        if ($request->get('price')) {
            $product->setPrice($request->get('price'));
        }
        if ($request->get('quantity')) {
            $product->setQuantity($request->get('quantity'));
        }
        $product->setModifiedAt(new \DateTime());

        $em->persist($product);
        $em->flush();

        return $this->respond($product);
    }
    /**
     * @Route("/product/remove/{id}")
     * @Method("DELETE")
     */
    public function deleteProductAction(int $id, Request $request, ProductRepository $productRepository, EntityManagerInterface $em): ?object
    {
        $request = $this->transformJsonBody($request);

        if (! $request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        if (! $this->userAuthorization($request, $em) ) {
           return $this->respondUnauthorized();
        }

        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        $product = $productRepository->find($id);
        if (! $product) {
            return $this->respondNotFound();
        }

        $em->remove($product);
        $em->flush();

        return $this->respond([
            'deleted' => $product->getId()
        ]);
    }
}

?>
