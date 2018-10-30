<?php // spec/Controller/ProductControllerSpec.php
 
namespace App\Spec\Controller;
 
describe('ProductController', function () {
 
    describe('/product/all', function () {
 
        it('list all products', function () {
 
            $request = $this->request->create('/product/all', 'GET');
            $response = $this->kernel->handle($request);
 
            var_dump($response);
        });
 
    });
 
});
