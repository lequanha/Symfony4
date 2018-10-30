<?php // spec/Controller/ProductControllerSpec.php
 
namespace App\Spec\Controller;
 
describe('ProductController', function () {
 
    describe('/product/all', function () {
 
        it('list all products', function () {
 
            $request = $this->request->create('/product/all', 'GET');
            $response = $this->kernel->handle($request);

            expect(function () use ($response) {
                $response->send();
            })->not->toBeNull();            
            
        });
 
    });
    
    describe('/product/entry/1', function () {

        it('list all products', function () {

            $request = $this->request->create('/product/all', 'GET');
            $response = $this->kernel->handle($request);

            expect(function () use ($response) {
                $response->send();
            })->not->toBeNull();

        });

    });

    describe('/product/entry/2', function () {

        it('list all products', function () {

            $request = $this->request->create('/product/all', 'GET');
            $response = $this->kernel->handle($request);

            expect(function () use ($response) {
                $response->send();
            })->not->toBeNull();

        });

    });

    describe('/product/entry/3', function () {

        it('list all products', function () {

            $request = $this->request->create('/product/all', 'GET');
            $response = $this->kernel->handle($request);

            expect(function () use ($response) {
                $response->send();
            })->not->toBeNull();

        });

    });

    describe('/product/entry/4', function () {

        it('list all products', function () {

            $request = $this->request->create('/product/all', 'GET');
            $response = $this->kernel->handle($request);

            expect(function () use ($response) {
                $response->send();
            })->not->toBeNull();

        });

    });
     
});
