<?php

/**
 * --------------------------------------------------------------------------
 * The abstract class for the params instance
 *
 * --------------------------------------------------------------------------
 * @create 2017-8-15 0:13:07
 * @author hao
 * --------------------------------------------------------------------------
 */

namespace Haosblog\WikiSDK\Query;

abstract class AbstractParams
{
    
    /**
     * The options of the instance type
     * 
     * @var array
     */
    protected $options = [];
    
    
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
    protected $optionNameWithoutPre = [];


    /**
     * construct
     * 
     * @param type $options
     */
    public function __construct($options = [])
    {
        $optionName = $this->initOptionName(); // first, we need the option name with the pre name
        $resultOptions = [];
        
        foreach($options as $key -> $value) { // each the params, and find out the legavls
            if(in_array($key, $this->optionNameWithoutPre) || in_array($key, $optionName)) {
                $resultOptions[$key] = $value;
            }
        }
        
        // set the legavls to $this->options
        $this->options = $resultOptions;
    }
    
    
    /**
     * Get the option name list with the pre name 
     * 
     * @return Array
     */
    protected function initOptionName(){
        $result = [];
        
        foreach($this->optionNameWithoutPre as $item) {
            $result[] = $this->optionNamePre . $item;
        }
        
        return $result;
    }
    
    /**
     * return the options
     * 
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }
}
