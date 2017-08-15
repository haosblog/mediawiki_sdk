<?php

/**
 * Description of AbstractQuery
 *
 * @create 2017-8-14 18:21:53
 * @author hao
 */

namespace Haosblog\WikiSDK\Api\Query;

use Haosblog\WikiSDK\Core\AbstractAPI;
use Haosblog\WikiSDK\Api\TraitAPI;

class Query extends AbstractAPI
{
    
    use TraitAPI;
    
    /**
     * add the prop param instance
     * 
     * @param \Haosblog\WikiSDK\Api\AbstractParams $prop
     * @return type
     */
    public function pushProp(AbstractParams $prop)
    {
        return $this->pushParamInstance($list, 'prop');
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

}
