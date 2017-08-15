<?php

/**
 * Description of AbstractQuery
 *
 * @create 2017-8-14 18:21:53
 * @author hao
 */

namespace Haosblog\WikiSDK\Query;

use Haosblog\WikiSDK\Core\AbstractAPI;

class Query extends AbstractAPI
{
    
    /**
     * the prop param instances
     * 
     * @var array
     */
    private $props = [];

    public function pushProp(AbstractParams $prop)
    {
        $propName = strtolower(get_class($prop));
        $this->props[$propName] = $prop;
        
        return $this;
    }
    
    
    public function pushList(AbstractParams $list){
        $listParamName = strtolower(get_class($list));
        
        $this->lists[$listParamName] = $list;
        
        return $this;
    }

}
