<?php

use volkerschulz\WordPressPluginCreator\Names;

require_once('../vendor/autoload.php');

var_dump(Names::getAll());

var_dump(Names::createFromDisplayName('My WordPress test plugin'));
