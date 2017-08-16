<?php

/**
 * 豆瓣SDK抽象基类
 *
 * @create 2017-7-31 17:21:31
 * @author hao
 */

namespace Haosblog\WikiSDK\Api;

use InvalidArgumentException;
use Haosblog\WikiSDK\Application;
use Haosblog\WikiSDK\Api\AbstractParams;
use Haosblog\WikiSDK\Core\Http;
use Haosblog\WikiSDK\Core\Log;

abstract class AbstractAPI
{

    /**
     * Http instance
     * 
     * @var \Haosblog\WikiSDK\Core\Http
     */
    protected $http;

    /**
     * instance of the Application
     * 
     * @var Application 
     */
    protected $app;

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
     * the action of current API,
     * if will be the param 'action' in the request url
     * 
     * @var array 
     */
    protected $apiAction = '';
    
    /**
     * the method we request the API
     * 
     * @var type 
     */
    protected $requestMethod = 'get';

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get the Http instance
     * 
     * @return Http
     */
    protected function getHttp()
    {
        if (!$this->http instanceof Http) {
            $this->http = new Http();
        }

        return $this->http;
    }

    /**
     * GET request.
     *
     * @param string $url
     * @param array  $options
     * @return ResponseInterface
     */
    protected function get($url, array $options = [])
    {
        $url = $this->formatUrl($url);
        return $this->getHttp()->get($url, $options);
    }

    /**
     * POST request.
     *
     * @param string       $url
     * @param array|string $options
     * @return ResponseInterface
     */
    protected function post($url, $options = [])
    {
        $url = $this->formatUrl($url);
        return $this->getHttp()->post($url, $options);
    }

    /**
     * POST request the API and decode as json
     * 
     * @param string $url
     * @param array $options
     */
    protected function postAndParseJson($url, $options = [])
    {
        $options = $this->setOptionsFormat($options);
        return $this->parseJSON($this->post($url, $options)->getBody());
    }

    /**
     * GET request the API and decode as json
     * 
     * @param string $url
     * @param array $options
     */
    protected function getAndParseJson($url, $options = [])
    {
        $options = $this->setOptionsFormat($options);
        return $this->parseJSON($this->get($url, $options)->getBody());
    }

    protected function formatUrl($url)
    {
        $baseUrl = $this->app->getBaseUrl();

        return $baseUrl . $url;
    }

    protected function setOptionsFormat($options, $format = 'json')
    {
        if (!isset($options['format']) || $options['format'] != $format) {
            $options['format'] = $format;
        }

        return $options;
    }

    /**
     * 
     * @param \Psr\Http\Message\ResponseInterface|string $body
     * @throws \InvalidArgumentException
     * @return array
     */
    protected function parseJSON($body)
    {
        if ($body instanceof ResponseInterface) {
            $body = $body->getBody();
        }

        if (empty($body)) {
            return false;
        }
        file_put_contents('D:\hao\web\debug.txt', $body);
        try {
            $contents = \GuzzleHttp\json_decode($body, true);
            Log::debug('API response decoded:', compact('contents'));
        } catch (InvalidArgumentException $ex) {
            Log::error('API response decoded error:', [
                'ErrorMessage' => $ex->getMessage(),
                'OriginalData' => $body,
            ]);

            throw $ex;
        }

        return $contents;
    }

    /**
     * add the param instance
     * 
     * @param \Haosblog\WikiSDK\Api\AbstractParams $meta
     * @return type
     */
    public function pushParamInstance(AbstractParams $param, $type = '')
    {
        $listParamClassName = strtolower(get_class($param));
        $listParamName = substr($listParamClassName, strrpos($listParamClassName, '\\') + 1);
        $this->paramInstances[$type][$listParamName] = $param;

        return $this;
    }

    /**
     * send request to the API
     * 
     * @return array
     */
    public function send()
    {
        $options = array_merge($this->params, $this->paramInstancesToOptions());
        $options = $this->setOptionsFormat($options);
        
        $method = $this->requestMethod;
        $url = $this->app->getBaseUrl() .'?action='. $this->apiAction;
        $http = $this->getHttp();
        $jsonResult = call_user_func_array([$http, $method], [$url, $options]);
        echo(get_class($jsonResult));die;
        $result = $this->parseJSON($jsonResult);
        
        return $this->prepareResult($result);
    }

    /**
     * prepare the paramInstances, set the params, and find out the sub params
     * 
     * @return type
     */
    private function paramInstancesToOptions()
    {
        if (empty($this->paramInstances)) {
            return [];
        }

        $result = [];

        // each the paramsInstances
        foreach ($this->paramInstances as $key => $paramItem) {
            // if the item is an array, then we need set the current param to the list of the array
            // like that: list=categories|categoryinfo|contributors
            // and then read the instance to get the sub params
            if (is_array($paramItem)) {
                $currentValueArray = array_keys($paramItem);
                $currentValue = implode('|', $currentValueArray);
                foreach ($paramItem as $item) {
                    if($item instanceof AbstractParams) {
                        $result = array_merge($result, $item->getOptions());
                    }
                }
            } elseif($paramItem instanceof AbstractParams) {
                $currentValue = strtolower(get_class($paramItem));
                $result = array_merge($result, $paramItem->getOptions());
            } else {
                $currentValue = $paramItem;
            }

            $result[$key] = $currentValue;
        }
        
        return $result;
    }
    
    public function __set($name, $value)
    {
        $this->params[$name] = $value;
    }


    abstract public function prepareResult($result);
}
