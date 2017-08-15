<?php

/**
 * query meta params token
 *
 * @create 2017-8-15 17:54:39
 * @author hao
 */

namespace Haosblog\WikiSDK\Api\Query\Props;

use InvalidArgumentException;
use Haosblog\WikiSDK\Api\AbstractParams;

class Token extends AbstractParams
{
    
    
    
    /**
     * The pre name for the option name of the instance
     * 
     * @var string 
     */
    protected $optionNamePre = '';
    
    /**
     * List of the option name for the instance(without pre name)
     * 
     * @var array 
     */
    protected $optionNameWithoutPre = [
        'type',
    ];
    
    protected function filterOptions($options)
    {
        $type = $options['type'];
        $legavls = [
            'createaccount',
            'csrf',
            'login',
            'patrol',
            'rollback',
            'userrights',
            'watch',
        ];
        
        if(strpos($type, '|') !== false){
            $types = explode('|', $type);
            
            foreach($types as $key => $item){
                // if the value invalid, remove it
                if(!in_array($item, $legavls)) {
                    unset($types[$key]);
                }
            }
            
            // after remove all the invalid value, check the result if empty
            // if empty, throw exception
            throw new InvalidArgumentException('the token type unlegal:'. $type);
        } elseif(!in_array($types, $legavls)) {
            throw new InvalidArgumentException('unkonw token type:'. $type);
        }
    }

}
