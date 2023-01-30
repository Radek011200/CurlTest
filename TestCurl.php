<?php

require_once __DIR__ . '/vendor/autoload.php';

$curl = new \Radoslaw\CurlTest\CurlTest();
var_dump($curl->createSomeObject(), $curl->getObject(11), $curl->updateObject(2));