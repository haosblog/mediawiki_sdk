<?php

/**
 * 豆瓣SDK抽象基类
 *
 * @create 2017-7-31 17:21:31
 * @author hao
 */

namespace Haosblog\WikiSDK\Core;

use InvalidArgumentException;
use Haosblog\WikiSDK\Application;

class AbstractAPI
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
    
    protected function formatUrl($url){
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

}
