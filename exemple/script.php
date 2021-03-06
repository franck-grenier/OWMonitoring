<?php

require 'autoload.php';

$cli = eZCLI::instance( );
$script = eZScript::instance( array(
    'description' => ("eZ Publish Migration Handler\n" . "Permet le déploiement des modifications à effextuer au n iveau de la base de données\n" . "\n" . ".extension/OWMigration/bin/php/migrate.php --migration-class=MigrationClass"),
    'use-session' => false,
    'use-modules' => true,
    'use-extensions' => true
) );

$script->startup( );
$sys = eZSys::instance( );
$script->initialize( );
try {
    $report = new OWMonitoringReport( 'ezpublish.import.company' );
    $report->setData( 'create', intval( rand( 1, 60 ) ) );
    $report->appendToData( 'create', intval( rand( 1, 60 ) ) );
    $report->setData( 'time_import', intval( rand( 20, 40 ) ) );
    $report->setData( 'update', intval( rand( 60, 100 ) ) );
    $report->sendReport( );
} catch(Exception $e) {
    echo $e->getMessage( ) . PHP_EOL;
}
try {
    $report = OWMonitoringReport::makeReport( 'DatabaseIntegrity' );
    $report->sendReport( );
} catch(Exception $e) {
    echo $e->getMessage( ) . PHP_EOL;
}
try {
    $report = OWMonitoringReport::makeReport( 'eZInfo' );
    $report->sendReport( );
} catch(Exception $e) {
    echo $e->getMessage( ) . PHP_EOL;
}

$script->shutdown( 0 );
?>