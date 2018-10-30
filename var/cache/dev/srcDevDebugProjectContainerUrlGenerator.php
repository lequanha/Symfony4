<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = array(
        'app_category_index' => array(array(), array('_controller' => 'App\\Controller\\CategoryController::index'), array(), array(array('text', '/category/all')), array(), array()),
        'app_category_postcategory' => array(array(), array('_controller' => 'App\\Controller\\CategoryController::postCategoryAction'), array(), array(array('text', '/category/new')), array(), array()),
        'app_product_index' => array(array(), array('_controller' => 'App\\Controller\\ProductController::index'), array(), array(array('text', '/product/all')), array(), array()),
        'app_product_getproduct' => array(array('id'), array('_controller' => 'App\\Controller\\ProductController::getProductAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/product/entry')), array(), array()),
        'app_product_postproduct' => array(array(), array('_controller' => 'App\\Controller\\ProductController::postProductAction'), array(), array(array('text', '/product/new')), array(), array()),
        'app_product_updateproduct' => array(array(), array('_controller' => 'App\\Controller\\ProductController::updateProductAction'), array(), array(array('text', '/product/update')), array(), array()),
        'app_product_deleteproduct' => array(array('id'), array('_controller' => 'App\\Controller\\ProductController::deleteProductAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/product/remove')), array(), array()),
        'api_entrypoint' => array(array('index', '_format'), array('_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => '1', 'index' => 'index'), array('index' => 'index'), array(array('variable', '.', '[^/]++', '_format'), array('variable', '/', 'index', 'index'), array('text', '/api')), array(), array()),
        'api_doc' => array(array('_format'), array('_controller' => 'api_platform.action.documentation', '_api_respond' => '1', '_format' => ''), array(), array(array('variable', '.', '[^/]++', '_format'), array('text', '/api/docs')), array(), array()),
        'api_jsonld_context' => array(array('shortName', '_format'), array('_controller' => 'api_platform.jsonld.action.context', '_api_respond' => '1', '_format' => 'jsonld'), array('shortName' => '.+'), array(array('variable', '.', '[^/]++', '_format'), array('variable', '/', '.+', 'shortName'), array('text', '/api/contexts')), array(), array()),
        'api_products_get_collection' => array(array('_format'), array('_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Product', '_api_collection_operation_name' => 'get'), array(), array(array('variable', '.', '[^/]++', '_format'), array('text', '/api/products')), array(), array()),
        'api_products_post_collection' => array(array('_format'), array('_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Product', '_api_collection_operation_name' => 'post'), array(), array(array('variable', '.', '[^/]++', '_format'), array('text', '/api/products')), array(), array()),
        'api_products_get_item' => array(array('id', '_format'), array('_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Product', '_api_item_operation_name' => 'get'), array(), array(array('variable', '.', '[^/]++', '_format'), array('variable', '/', '[^/\\.]++', 'id'), array('text', '/api/products')), array(), array()),
        'api_products_delete_item' => array(array('id', '_format'), array('_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Product', '_api_item_operation_name' => 'delete'), array(), array(array('variable', '.', '[^/]++', '_format'), array('variable', '/', '[^/\\.]++', 'id'), array('text', '/api/products')), array(), array()),
        'api_products_put_item' => array(array('id', '_format'), array('_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Product', '_api_item_operation_name' => 'put'), array(), array(array('variable', '.', '[^/]++', '_format'), array('variable', '/', '[^/\\.]++', 'id'), array('text', '/api/products')), array(), array()),
        'api_categories_get_collection' => array(array('_format'), array('_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Category', '_api_collection_operation_name' => 'get'), array(), array(array('variable', '.', '[^/]++', '_format'), array('text', '/api/categories')), array(), array()),
        'api_categories_post_collection' => array(array('_format'), array('_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Category', '_api_collection_operation_name' => 'post'), array(), array(array('variable', '.', '[^/]++', '_format'), array('text', '/api/categories')), array(), array()),
        'api_categories_get_item' => array(array('id', '_format'), array('_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Category', '_api_item_operation_name' => 'get'), array(), array(array('variable', '.', '[^/]++', '_format'), array('variable', '/', '[^/\\.]++', 'id'), array('text', '/api/categories')), array(), array()),
        'api_categories_delete_item' => array(array('id', '_format'), array('_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Category', '_api_item_operation_name' => 'delete'), array(), array(array('variable', '.', '[^/]++', '_format'), array('variable', '/', '[^/\\.]++', 'id'), array('text', '/api/categories')), array(), array()),
        'api_categories_put_item' => array(array('id', '_format'), array('_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Category', '_api_item_operation_name' => 'put'), array(), array(array('variable', '.', '[^/]++', '_format'), array('variable', '/', '[^/\\.]++', 'id'), array('text', '/api/categories')), array(), array()),
        '_twig_error_test' => array(array('code', '_format'), array('_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'), array('code' => '\\d+'), array(array('variable', '.', '[^/]++', '_format'), array('variable', '/', '\\d+', 'code'), array('text', '/_error')), array(), array()),
    );
        }
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && (self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
            unset($parameters['_locale']);
            $name .= '.'.$locale;
        } elseif (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
