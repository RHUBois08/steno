<?php
require(__DIR__.'/vendor/autoload.php');

use Kreait\Firebase\Factory;

$factory = (new Factory())
    ->withProjectId('steno-php')
    ->withDatabaseUri('https://steno-php.firebaseio.com');

$database = $factory->createDatabase();    
?>