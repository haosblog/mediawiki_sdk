<?php

/**
 * This is a file for debug
 * It will remove when the project release
 *
 * @create 2017-8-16 17:53:21
 * @author hao
 */

require __DIR__ .'/../tests/bootstrap.php';

use Haosblog\WikiSDK\Module\Page\Reader;
use Haosblog\WikiSDK\Application;

$app = new Application('http://wiki.42sfw.com/api.php');

$query = new Reader($app);

print_r($query->getParsedRevions('刘慈欣'));