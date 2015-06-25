<?php

namespace LocalBooking\Console;

use LocalBooking\Config\Loader;
use Illuminate\Database\Capsule\Manager as Capsule;
use Webmozart\Console\Api\Args\Format\Option;
use Webmozart\Console\Config\DefaultApplicationConfig;


/**
 * Application
 *
 * @author Danilo Kuehn <dk@nogo-software.de>
 */
class Application extends DefaultApplicationConfig
{

    /**
     * @var Loader
     */
    protected $config;

    /**
     * @var Capsule
     */
    protected $database;

    public function __construct(Loader $config, Capsule $database)
    {
        $this->config = $config;
        $this->database = $database;

        parent::__construct('console', '1.0.0');
    }

    protected function configure()
    {
        parent::configure();

        $this
            ->setHelp('localBooking Console')

            ->beginCommand('database')
                ->setDescription('Database commands')
                ->setHandler(new DatabaseHandler($this->config, $this->database))
                ->beginSubCommand('create')
                    ->setDescription('Create database')
                    ->setHandlerMethod('create')
                ->end()
                ->beginSubCommand('migrate')
                    ->setDescription('Migrate database')
                    ->setHandlerMethod('migrate')
                ->end()
                ->beginSubCommand('seed')
                    ->setDescription('Seed database')
                    ->addOption('truncate', null, Option::NO_VALUE, 'Truncate database')
                    ->setHandlerMethod('seed')
                ->end()
            ->end()
        ;
    }
}
