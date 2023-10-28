<?php

use volkerschulz\WordPressPluginCreator\Config;

require_once('../vendor/autoload.php');

var_dump(Config::load(__DIR__ . '/../config-sample.ini'));
