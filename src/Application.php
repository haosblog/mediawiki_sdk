<?php

/**
 *  entrance of the wiki sdk
 *
 * @create 2017-8-14 18:10:29
 * @author hao
 */

namespace Haosblog\WikiSDK;

use Haosblog\WikiSDK\Query\Query;

class Application
{

    /**
     * the base url of the wiki website
     * 
     * @var string
     */
    protected $baseUrl = '';

    /**
     * the query action instances
     * 
     * @var array 
     */
    protected $actionQuery;

    /**
     * construct
     * 
     * @param array $config
     */
    public function __construct($config)
    {
        if (isset($config['domain'])) {
            $this->baseUrl = $config['domain'];
        }
    }

    /**
     * get the base url
     * 
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function getQuery()
    {
        if (!$this->actionQuery instanceof Query) {
            $this->actionQuery = new Query($this);
        }
        
        return $this->actionQuery;
    }

}
