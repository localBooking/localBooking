<?php

namespace LocalBooking\Controller;

use LocalBooking\Model\Resource;
use Slim\Http\Response;
use Slim\Slim;

class CatalogController implements ControllerInterface
{
    /**
     * @var Slim
     */
    protected $app;

    /**
     * @var array
     */
    protected $config;

    public function enable($app)
    {
        $this->setApp($app);
        $this->setConfig($app->config('api'));


        $this
            ->getApp()
            ->get(sprintf('%s/catalog', $this->getConfig('prefix')), [$this, 'listAction'])
            ->name('catalog_list')
            ;
    }

    public function beforeAction(\Slim\Route $route)
    {
        $resource = $route->getParam('resource');
        if (!array_key_exists($resource, $this->getConfig('resources'))) {
            $this->app->halt(404, json_encode(['error' => 'Resource [' . $resource . '] not found.']));
        }
    }

    public function listAction()
    {
        $resources = Resource::with('prices')->get()->toArray();

        $response = [];

        foreach ($resources as $resource) {
             $data = [
                'name' => $resource['name'],
                'description' => $resource['description'],
                'media' => $resource['media'],
            ];

            foreach ($resource['prices'] as $price) {
                $options = json_decode($price['pivot']['options'], true);
                $data['prices'][] = [
                    'price' => $price['price'],
                    'tax_rate' => $price['tax_rate'],
                    'quantity' => $price['quantity'],
                    'options' => $options
                ];

            }

            $response[$resource['id']] = $data;
        }

        $this->getApp()->response->body(json_encode($response));
    }


    /* Getter & Setter */

    /**
     * @return Slim
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param Slim $app
     *
     * @return CatalogController
     */
    public function setApp(Slim $app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * @return array|string
     */
    public function getConfig($key = null)
    {
        if (!is_null($key)) {
            if (!isset($this->config[$key])) {
                throw new \Exception(sprintf('Configuration key "%s" not found', $key));
            }

            return $this->config[$key];
        }

        return $this->config;
    }

    /**
     * @param array $config
     *
     * @return CatalogController
     */
    public function setConfig(Array $config)
    {
        $this->config = $config;

        return $this;
    }


}
