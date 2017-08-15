<?php

/**
 * Description of TraitAPI
 *
 * @create 2017-8-15 18:39:22
 * @author hao
 */

namespace Haosblog\WikiSDK\Api;

trait TraitAPI
{
    
    /**
     * the params
     * 
     * @var array
     */
    protected $params = [];
    
    /**
     * the params instances
     * 
     * @var array
     */
    protected $paramInstances = [];
    
    
    /**
     * add the param instance
     * 
     * @param \Haosblog\WikiSDK\Api\AbstractParams $meta
     * @return type
     */
    public function pushParamInstance(AbstractParams $param, $type = ''){
        $listParamName = strtolower(get_class($param));
        
        $this->paramInstances[$type][$listParamName] = $param;
        
        return $this;
    }
    
    
    /**
     * 
     * @return array
     */
    public function send(){
        
    }
}
