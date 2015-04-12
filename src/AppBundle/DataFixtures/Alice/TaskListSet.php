<?php

use h4cc\AliceFixturesBundle\Fixtures\FixtureSet;

$set = new FixtureSet( array(
    'locale' => 'es_ES',
    'do_drop' => true,
    'do_persist' => true,
));

$set->addFile( __DIR__.'/organizations.yml', 'yaml' );
$set->addFile( __DIR__.'/conventions.yml', 'yaml' );
$set->addFile( __DIR__.'/users.yml', 'yaml' );

return $set;