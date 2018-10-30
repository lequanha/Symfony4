<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = $allowSchemes = array();
        if ($ret = $this->doMatch($pathinfo, $allow, $allowSchemes)) {
            return $ret;
        }
        if ($allow) {
            throw new MethodNotAllowedException(array_keys($allow));
        }
        if (!in_array($this->context->getMethod(), array('HEAD', 'GET'), true)) {
            // no-op
        } elseif ($allowSchemes) {
            redirect_scheme:
            $scheme = $this->context->getScheme();
            $this->context->setScheme(key($allowSchemes));
            try {
                if ($ret = $this->doMatch($pathinfo)) {
                    return $this->redirect($pathinfo, $ret['_route'], $this->context->getScheme()) + $ret;
                }
            } finally {
                $this->context->setScheme($scheme);
            }
        } elseif ('/' !== $pathinfo) {
            $pathinfo = '/' !== $pathinfo[-1] ? $pathinfo.'/' : substr($pathinfo, 0, -1);
            if ($ret = $this->doMatch($pathinfo, $allow, $allowSchemes)) {
                return $this->redirect($pathinfo, $ret['_route']) + $ret;
            }
            if ($allowSchemes) {
                goto redirect_scheme;
            }
        }

        throw new ResourceNotFoundException();
    }

    private function doMatch(string $rawPathinfo, array &$allow = array(), array &$allowSchemes = array()): ?array
    {
        $allow = $allowSchemes = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $context = $this->context;
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        switch ($pathinfo) {
            default:
                $routes = array(
                    '/category/all' => array(array('_route' => 'app_category_index', '_controller' => 'App\\Controller\\CategoryController::index'), null, null, null),
                    '/category/new' => array(array('_route' => 'app_category_postcategory', '_controller' => 'App\\Controller\\CategoryController::postCategoryAction'), null, null, null),
                    '/product/all' => array(array('_route' => 'app_product_index', '_controller' => 'App\\Controller\\ProductController::index'), null, null, null),
                    '/product/new' => array(array('_route' => 'app_product_postproduct', '_controller' => 'App\\Controller\\ProductController::postProductAction'), null, null, null),
                    '/product/update' => array(array('_route' => 'app_product_updateproduct', '_controller' => 'App\\Controller\\ProductController::updateProductAction'), null, null, null),
                );

                if (!isset($routes[$pathinfo])) {
                    break;
                }
                list($ret, $requiredHost, $requiredMethods, $requiredSchemes) = $routes[$pathinfo];

                $hasRequiredScheme = !$requiredSchemes || isset($requiredSchemes[$context->getScheme()]);
                if ($requiredMethods && !isset($requiredMethods[$canonicalMethod]) && !isset($requiredMethods[$requestMethod])) {
                    if ($hasRequiredScheme) {
                        $allow += $requiredMethods;
                    }
                    break;
                }
                if (!$hasRequiredScheme) {
                    $allowSchemes += $requiredSchemes;
                    break;
                }

                return $ret;
        }

        $matchedPathinfo = $pathinfo;
        $regexList = array(
            0 => '{^(?'
                    .'|/product/(?'
                        .'|entry/([^/]++)(*:33)'
                        .'|remove/([^/]++)(*:55)'
                    .')'
                    .'|/api(?'
                        .'|(?:/(index)(?:\\.([^/]++))?)?(*:98)'
                        .'|/(?'
                            .'|docs(?:\\.([^/]++))?(*:128)'
                            .'|c(?'
                                .'|ontexts/(.+)(?:\\.([^/]++))?(*:167)'
                                .'|ategories(?'
                                    .'|(?:\\.([^/]++))?(?'
                                        .'|(*:205)'
                                    .')'
                                    .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                        .'|(*:243)'
                                    .')'
                                .')'
                            .')'
                            .'|products(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:283)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:321)'
                                .')'
                            .')'
                        .')'
                    .')'
                    .'|/_error/(\\d+)(?:\\.([^/]++))?(*:361)'
                .')$}sD',
        );

        foreach ($regexList as $offset => $regex) {
            while (preg_match($regex, $matchedPathinfo, $matches)) {
                switch ($m = (int) $matches['MARK']) {
                    case 205:
                        $matches = array('_format' => $matches[1] ?? null);

                        // api_categories_get_collection
                        $ret = $this->mergeDefaults(array('_route' => 'api_categories_get_collection') + $matches, array('_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Category', '_api_collection_operation_name' => 'get'));
                        if (!isset(($a = array('GET' => 0))[$canonicalMethod])) {
                            $allow += $a;
                            goto not_api_categories_get_collection;
                        }

                        return $ret;
                        not_api_categories_get_collection:

                        // api_categories_post_collection
                        $ret = $this->mergeDefaults(array('_route' => 'api_categories_post_collection') + $matches, array('_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Category', '_api_collection_operation_name' => 'post'));
                        if (!isset(($a = array('POST' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_api_categories_post_collection;
                        }

                        return $ret;
                        not_api_categories_post_collection:

                        break;
                    case 243:
                        $matches = array('id' => $matches[1] ?? null, '_format' => $matches[2] ?? null);

                        // api_categories_get_item
                        $ret = $this->mergeDefaults(array('_route' => 'api_categories_get_item') + $matches, array('_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Category', '_api_item_operation_name' => 'get'));
                        if (!isset(($a = array('GET' => 0))[$canonicalMethod])) {
                            $allow += $a;
                            goto not_api_categories_get_item;
                        }

                        return $ret;
                        not_api_categories_get_item:

                        // api_categories_delete_item
                        $ret = $this->mergeDefaults(array('_route' => 'api_categories_delete_item') + $matches, array('_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Category', '_api_item_operation_name' => 'delete'));
                        if (!isset(($a = array('DELETE' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_api_categories_delete_item;
                        }

                        return $ret;
                        not_api_categories_delete_item:

                        // api_categories_put_item
                        $ret = $this->mergeDefaults(array('_route' => 'api_categories_put_item') + $matches, array('_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Category', '_api_item_operation_name' => 'put'));
                        if (!isset(($a = array('PUT' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_api_categories_put_item;
                        }

                        return $ret;
                        not_api_categories_put_item:

                        break;
                    case 283:
                        $matches = array('_format' => $matches[1] ?? null);

                        // api_products_get_collection
                        $ret = $this->mergeDefaults(array('_route' => 'api_products_get_collection') + $matches, array('_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Product', '_api_collection_operation_name' => 'get'));
                        if (!isset(($a = array('GET' => 0))[$canonicalMethod])) {
                            $allow += $a;
                            goto not_api_products_get_collection;
                        }

                        return $ret;
                        not_api_products_get_collection:

                        // api_products_post_collection
                        $ret = $this->mergeDefaults(array('_route' => 'api_products_post_collection') + $matches, array('_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Product', '_api_collection_operation_name' => 'post'));
                        if (!isset(($a = array('POST' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_api_products_post_collection;
                        }

                        return $ret;
                        not_api_products_post_collection:

                        break;
                    case 321:
                        $matches = array('id' => $matches[1] ?? null, '_format' => $matches[2] ?? null);

                        // api_products_get_item
                        $ret = $this->mergeDefaults(array('_route' => 'api_products_get_item') + $matches, array('_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Product', '_api_item_operation_name' => 'get'));
                        if (!isset(($a = array('GET' => 0))[$canonicalMethod])) {
                            $allow += $a;
                            goto not_api_products_get_item;
                        }

                        return $ret;
                        not_api_products_get_item:

                        // api_products_delete_item
                        $ret = $this->mergeDefaults(array('_route' => 'api_products_delete_item') + $matches, array('_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Product', '_api_item_operation_name' => 'delete'));
                        if (!isset(($a = array('DELETE' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_api_products_delete_item;
                        }

                        return $ret;
                        not_api_products_delete_item:

                        // api_products_put_item
                        $ret = $this->mergeDefaults(array('_route' => 'api_products_put_item') + $matches, array('_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Product', '_api_item_operation_name' => 'put'));
                        if (!isset(($a = array('PUT' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_api_products_put_item;
                        }

                        return $ret;
                        not_api_products_put_item:

                        break;
                    default:
                        $routes = array(
                            33 => array(array('_route' => 'app_product_getproduct', '_controller' => 'App\\Controller\\ProductController::getProductAction'), array('id'), null, null),
                            55 => array(array('_route' => 'app_product_deleteproduct', '_controller' => 'App\\Controller\\ProductController::deleteProductAction'), array('id'), null, null),
                            98 => array(array('_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => '1', 'index' => 'index'), array('index', '_format'), null, null),
                            128 => array(array('_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_api_respond' => '1', '_format' => ''), array('_format'), null, null),
                            167 => array(array('_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_api_respond' => '1', '_format' => 'jsonld'), array('shortName', '_format'), null, null),
                            361 => array(array('_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'), array('code', '_format'), null, null),
                        );

                        list($ret, $vars, $requiredMethods, $requiredSchemes) = $routes[$m];

                        foreach ($vars as $i => $v) {
                            if (isset($matches[1 + $i])) {
                                $ret[$v] = $matches[1 + $i];
                            }
                        }

                        $hasRequiredScheme = !$requiredSchemes || isset($requiredSchemes[$context->getScheme()]);
                        if ($requiredMethods && !isset($requiredMethods[$canonicalMethod]) && !isset($requiredMethods[$requestMethod])) {
                            if ($hasRequiredScheme) {
                                $allow += $requiredMethods;
                            }
                            break;
                        }
                        if (!$hasRequiredScheme) {
                            $allowSchemes += $requiredSchemes;
                            break;
                        }

                        return $ret;
                }

                if (361 === $m) {
                    break;
                }
                $regex = substr_replace($regex, 'F', $m - $offset, 1 + strlen($m));
                $offset += strlen($m);
            }
        }
        if ('/' === $pathinfo && !$allow && !$allowSchemes) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        return null;
    }
}
