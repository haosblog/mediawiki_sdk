<?php

/**
 * 豆瓣SDK抽象基类
 *
 * @create 2017-7-31 17:21:31
 * @author hao
 */

namespace Haosblog\WikiSDK\Core;

use InvalidArgumentException;

use GuzzleHttp\Client;

class AbstractAPI
{
    /**
     * Http instance
     * 
     * @var \Haosblog\WikiSDK\Core\Http
     */
    protected $http;

    /**
     * Get the Http instance
     * 
     * @return Http
     */
    protected function getHttp()
    {
        if(!$this->http instanceof Http){
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
        return $this->getHttp()->post($url, $options);
    }
    
    /**
     * POST request the API and decode as json
     * 
     * @param string $url
     * @param array $options
     */
    protected function postAndParseJson($url, $options = []){
        return $this->parseJSON($this->post($url, $options)->getBody());
    }
    
    
    /**
     * GET request the API and decode as json
     * 
     * @param string $url
     * @param array $options
     */
    protected function getAndParseJson($url, $options = []){
        return $this->parseJSON($this->get($url, $options)->getBody());
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

        try{
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
    
}
