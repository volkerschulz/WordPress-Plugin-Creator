<?php

use volkerschulz\WordPressPluginCreator\Config;
use volkerschulz\WordPressPluginCreator\Names;
use volkerschulz\WordPressPluginCreator\Folders;
use volkerschulz\WordPressPluginCreator\Files;

require_once(realpath(__DIR__) . '/vendor/autoload.php');

if(!php_sapi_name() === 'cli')
    die("This application must be called from the CLI" . PHP_EOL);

$plugin_name = $argv[1];

Config::load(realpath(__DIR__));

if(!Names::createFromDisplayName($plugin_name))
    die("Error: Could not create names" . PHP_EOL);

$output_directory = realpath(__DIR__ . '/output');
if(!Folders::create($output_directory)) 
    die("Error: Could not directories" . PHP_EOL);

$template_path = realpath(__DIR__ . '/templates/default/v1');
if(!Files::copyFromTemplate($template_path))
    die("Error: Could not copy files" . PHP_EOL);

die("Done! Find your plugin at '{$output_directory}'" . PHP_EOL);