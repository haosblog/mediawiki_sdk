<?php

/**
 * --------------------------------------------------------------------------
 * query prop params revisions
 *
 * --------------------------------------------------------------------------
 * @create 2017-8-15 0:01:21
 * @author hao
 * --------------------------------------------------------------------------
 */

namespace Haosblog\WikiSDK\Api\Query\Props;

use Haosblog\WikiSDK\Api\AbstractParams;

class Revisions extends AbstractParams
{
    
    /**
     * The pre name for the option name of the instance
     * 
     * @var string 
     */
    protected $optionNamePre = 'rv';
    
    /**
     * List of the option name for the instance(without pre name)
     * 
     * @var array 
     */
    protected $optionNameWithoutPre = [
        'prop',
        'limit',
        'expandtemplates',
        'generatexml',
        'parse',
        'section',
        'diffto',
        'difftotext',
        'difftotextpst',
        'contentformat',
        'startid',
        'startid',
        'start',
        'end',
        'dir',
        'user',
        'excludeuser',
        'tag',
        'token',
        'continue',
    ];
    
    /**
     * filter the options
     * 
     * @param type $options
     */
    protected function filterOptions($options)
    {
        if(isset($options['rvparse']) && $options['rvparse'] === false){
            unset($options['rvparse']);
        }
    }

}
