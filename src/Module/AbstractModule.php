<?php

/**
 * Description of AbstractModule
 *
 * @create 2017-8-16 18:05:49
 * @author hao
 */

namespace Haosblog\WikiSDK\Module;

use Haosblog\WikiSDK\Application;

class AbstractModule
{

    /**
     * instance of the Application
     * 
     * @var Application 
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}
