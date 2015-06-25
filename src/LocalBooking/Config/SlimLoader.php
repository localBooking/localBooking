<?php
namespace LocalBooking\Config;

use Slim\Slim;

/**
 * SlimLoader - Yaml configuration loader with Slim adapter.
 *
 * @package Config
 */
class SlimLoader extends Loader
{
    /**
     * @var Slim
     */
    protected $app;

    /**
     * @param Slim $app
     */
    public function __construct(Slim $app)
    {
        $this->app = $app;
    }

    /**
     * Load config into slim configuration
     * @param Slim $app
     */
    public function refresh(Slim $app = null)
    {
        if ($app != null) {
            $this->app = $app;
        }
        $this->app->config($this->config);
    }
}
