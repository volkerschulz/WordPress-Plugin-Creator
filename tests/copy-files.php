<?php

use volkerschulz\WordPressPluginCreator\Files;
use volkerschulz\WordPressPluginCreator\Names;
use volkerschulz\WordPressPluginCreator\Folders;

require_once('../vendor/autoload.php');

Names::createFromDisplayName('My WordPress test plugin');
Folders::create(__DIR__ . '/output/');

$template_path = realpath(__DIR__ . '/../templates/default/v1');
var_dump($template_path);
var_dump(Files::copyFromTemplate($template_path));