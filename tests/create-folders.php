<?php

use volkerschulz\WordPressPluginCreator\Names;
use volkerschulz\WordPressPluginCreator\Folders;

require_once('../vendor/autoload.php');

Names::createFromDisplayName('My WordPress Test Plugin');
var_dump(Folders::create(__DIR__ . '/output/'));