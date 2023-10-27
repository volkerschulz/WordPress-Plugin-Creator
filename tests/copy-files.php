<?php

use volkerschulz\WordPressPluginCreator\Config;
use volkerschulz\WordPressPluginCreator\Names;
use volkerschulz\WordPressPluginCreator\Folders;
use volkerschulz\WordPressPluginCreator\Files;

require_once('../vendor/autoload.php');

Config::load(__DIR__ . '/../config-sample.ini');
Names::createFromDisplayName('My WordPress test plugin');
Folders::create(__DIR__ . '/output/');

$template_path = realpath(__DIR__ . '/../templates/default/v1');
var_dump($template_path);
var_dump(Files::copyFromTemplate($template_path));