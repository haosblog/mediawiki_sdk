<?php

/**
 *  entrance of the wiki sdk
 *
 * @create 2017-8-14 18:10:29
 * @author hao
 */

namespace Haosblog\WikiSDK;

use Haosblog\WikiSDK\Api\Query\Query;

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
    public function __construct($baseUrl = '')
    {
        if (!empty($baseUrl)) {
            $this->baseUrl = $baseUrl;
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

    /**
     * 
     * 
     * @return Query
     */
    public function getQuery()
    {
        if (!$this->actionQuery instanceof Query) {
            $this->actionQuery = new Query($this);
        }
        
        return $this->actionQuery;
    }

}
