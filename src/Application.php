<?php

/**
 *  entrance of the wiki sdk
 *
 * @create 2017-8-14 18:10:29
 * @author hao
 */

namespace Haosblog\WikiSDK;

class Application
{
    
    /**
     * the domain of the wiki website
     * 
     * @var string
     */
    protected $wikiDomain = '';

    /**
     * the query action instance
     * 
     * @var type 
     */
    protected $actionQuery;
    
    /**
     * construct
     * 
     * @param array $config
     */
    public function __construct($config)
    {
        $this->wikiDomain = $config['domain'];
    }
    
    
    public function getQuery(){
        if(!$this->actionQuery instanceof Query){
            
        }
    }
}
