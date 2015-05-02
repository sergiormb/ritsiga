<?php

use h4cc\AliceFixturesBundle\Fixtures\FixtureSet;

$set = new FixtureSet(array(
	'locale' => 'es_ES',
	'do_drop' => true,
	'do_persist' => true,
));

$set->addFile(__DIR__ . '/organizations.yml', 'yaml');
$set->addFile(__DIR__ . '/conventions.yml', 'yaml');
$set->addFile(__DIR__ . '/university.yml', 'yaml');
$set->addFile(__DIR__ . '/colleges.yml', 'yaml');
$set->addFile(__DIR__ . '/academicdegree.yml', 'yaml');
$set->addFile(__DIR__ . '/studentdelegation.yml', 'yaml');
$set->addFile(__DIR__ . '/users.yml', 'yaml');


return $set;