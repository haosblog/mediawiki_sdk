<?php

/**
 * Description of AbstractQuery
 *
 * @create 2017-8-14 18:21:53
 * @author hao
 */

namespace Haosblog\WikiSDK\Api\Query;

use Haosblog\WikiSDK\Api\AbstractAPI;
use Haosblog\WikiSDK\Api\AbstractParams;

class Query extends AbstractAPI
{
    /**
     * current action is query
     * 
     * @var string
     */
    protected $apiAction = 'query';
    
    /**
     * add the prop param instance
     * 
     * @param \Haosblog\WikiSDK\Api\AbstractParams $prop
     * @return type
     */
    public function pushProp(AbstractParams $prop)
    {
        return $this->pushParamInstance($prop, 'prop');
    }
    
    
    /**
     * add the list param instance
     * 
     * @param \Haosblog\WikiSDK\Api\AbstractParams $list
     * @return type
     */
    public function pushList(AbstractParams $list){
        return $this->pushParamInstance($list, 'list');
    }
    
    
    /**
     * add the meta param instance
     * 
     * @param \Haosblog\WikiSDK\Api\AbstractParams $meta
     * @return type
     */
    public function pushMeta(AbstractParams $meta){
        return $this->pushParamInstance($meta, 'meta');
    }

    public function prepareResult($result)
    {
        return $result;
    }

}
