<?php

use volkerschulz\WordPressPluginCreator\Config;
use volkerschulz\WordPressPluginCreator\Names;
use volkerschulz\WordPressPluginCreator\Folders;
use volkerschulz\WordPressPluginCreator\Files;

require_once(realpath(__DIR__) . '/vendor/autoload.php');

if(!php_sapi_name() === 'cli')
    die("This application must be called from the CLI" . PHP_EOL);

if(empty($argv[1])) 
    die("Error: No plugin name provided\nUsage: php {$argv[0]} \"My Wordpress Plugin Name\"". PHP_EOL);

$plugin_name = $argv[1];

if(strlen($plugin_name)<10) {
    echo "Warning: Short plugin name - Using short names is discouraged" . PHP_EOL;
    if(!askUserToProceed())
        die();
}

Config::load(realpath(__DIR__));

if(!Names::createFromDisplayName($plugin_name))
    die("Error: Could not create names" . PHP_EOL);

$output_directory = realpath(__DIR__ . '/output');
if(!file_exists($output_directory)) {
    if(!mkdir($output_directory)) {
        die("Error: Output directory does not exist and failed to create" . PHP_EOL);
    }
}

$template_path = realpath(__DIR__ . '/templates/composer/v1');

if(!Folders::createFromTemplate($template_path, $output_directory)) 
    die("Error: Could not create directories" . PHP_EOL);

if(!Files::copyFromTemplate($template_path))
    die("Error: Could not copy files" . PHP_EOL);

die("Done! Find your plugin at '{$output_directory}'" . PHP_EOL);

function askUserToProceed() {
    while(true) {
        echo "Continue? [y,N] - ";
        $stdin = fopen('php://stdin', 'r');
        $response = trim(strtolower(fgets($stdin)));
        if(empty($response) || $response === 'n')
            return false;
        
        if(trim(strtolower($response)) === 'y') 
            return true;
        
    }
}