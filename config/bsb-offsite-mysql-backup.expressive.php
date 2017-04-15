<?php

declare(strict_types=1);

use BsbDoctrineRegistry\Container\ManagerRegistryFactory;
use BsbFlysystemMysqlBackup\Container\MysqlBackupServiceFactory;
use BsbFlysystemMysqlBackup\Container\MysqlDumperOptionsFactory;
use BsbFlysystemMysqlBackup\Container\MysqlDumperServiceFactory;
use BsbFlysystemMysqlBackup\Container\StorageOptionsFactory;
use BsbFlysystemMysqlBackup\Option\MysqlDumperOptions;
use BsbFlysystemMysqlBackup\Option\StorageOptions;
use BsbFlysystemMysqlBackup\Service\MysqlBackupService;
use BsbFlysystemMysqlBackup\Service\MysqlDumperService;
use Doctrine\Common\Persistence\ManagerRegistry;

return [
    'dependencies' => [
        'factories' => [
            /*
             * Main service
             */
            MysqlBackupService::class => MysqlBackupServiceFactory::class,

            /*
             * Internal services
             */
            MysqlDumperOptions::class => MysqlDumperOptionsFactory::class,
            StorageOptions::class     => StorageOptionsFactory::class,
            MysqlDumperService::class => MysqlDumperServiceFactory::class,

            /*
             * Provides an implementation of ManagerRegistry
             */
            // ManagerRegistry::class    => ManagerRegistryFactory::class
        ],
    ],
];
