<?php // spec/Controller/CategoryControllerSpec.php

namespace App\Spec\Controller;

describe('CategoryController', function () {

    describe('/category/all', function () {

        it('list all categories', function () {

            $request = $this->request->create('/category/all', 'GET');
            $response = $this->kernel->handle($request);

            expect(function () use ($response) {
                $response->send();
            })->not->toBeNull();

        });

    });

});

?>
