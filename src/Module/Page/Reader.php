<?php

/**
 * Description of Reader
 *
 * @create 2017-8-15 18:15:42
 * @author hao
 */

namespace Haosblog\WikiSDK\Module\Page;

use Haosblog\WikiSDK\Module\AbstractModule;

class Reader extends AbstractModule
{
    
    public function getParsedRevions($title){
        $query = $this->app->getQuery();
        $query->pushProp(new \Haosblog\WikiSDK\Api\Query\Props\Revisions([
            'prop' => 'ids|timestamp|user|comment|content|contentmodel',
            'parse' => '',
        ]));
        
        $query->titles = $title;
        
        return $query->send();
    }
    
}
