# BsbFlysystemMysqlBackup

A small library capable of creating and persisting a Mysql dump into a Flysystem filesystem.

Dependancies;

- [Mysqldump](https://github.com/ifsnop/mysqldump-php) to create a mysql dump
- [Flysystem](https://github.com/league/flysystem) to persist the dump


Compatible with [container-interop/container-interop](https://github.com/container-interop/container-interop) but completely optional.

No wiring is provided as code but I do provide some example configuration. Factories are provided for needed services but you must write a factory for a Flysystem service (see provided example).

## Installation

```
composer require "bushbaby/flysystem-mysql-backup"
```

## Usage

### Programaticly

```
// setup dumper 
$dumpOptions    = new MysqlDumperOptions();
$dumper         = new MysqlDumperService($dsn, $user, $password, $dumpOptions);

// setup storage 
$filesystem     = new Filesystem(new SomeFlystemAdapter());

// setup backup service
$storageOptions = new StorageOptions();
$backup         = new MysqlBackupService($dumperService, $filesystem, $storageOptions, $dumpSettings);

// invoke
$backup->doBackup();

$backup->pruneStorage();

```

### Factories (ContainerInterface)

If you choose to use the Factories to instanciate the service a `config` service is expected to be registered within the Container. That service should contain an `bsb_flysystem_mysql_backup` top level entry with the following keys.

- connection
- storage
- mysql_dump

The `connection` key must be an array with doctrine connection parameters

```
return [
    'bsb_flysystem_mysql_backup' => [
        'connection' => [
            'host'          => 'localhost',
            'user'          => 'dbuser',
            'password'      => 'dbpass',
            'dbname'        => 'dbname',
            'charset'       => 'utf8',
            'driverOptions' => [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ],
        ],
    ],
];    

```
or a doctrine connection name.

```
return [
    'bsb_flysystem_mysql_backup' => [
        'connection' => 'orm_default',
    ],
];    

```

When you use a doctrine connection name it is assumed an implementation of `Doctrine\Common\Persistence\ManagerRegistry` is registered within the Container. That service is used to retrieve the named connection.

I use this [one](https://github.com/bushbaby/BsbDoctrineManagerRegistryServiceManager).

### Storage options

The `storage` key must be an array containing

```
return [
    'bsb_flysystem_mysql_backup' => [
        'storage' => [

            /*
             * Container service name of the Flysystem filesystem used to persisted dumps
             *
             * @since 0.2.0 this may also be the name of a filesystem as it has been registered to the BsbFlysystem Manager
             */
            // 'filesystem'      => 'Container/Name/Of/FilesystemService',

            /*
             * Path within the Flysystem filesystem where dumps are persisted
             */
            // 'path'            => '/',

            /*
             * Store the basename of the last created backup in this file
             * false|string
             */
            // 'write_latest'    => false,
			
			/*
			 * Prune backup files from storage after creating a backup
			 */
            // 'auto_prune'    	  => false,
            
            /*
             * Prune backup files from storage when there are more than x files
             *
             * default 0 (disabled)
             */
            // 'prune_max_count' => 0,

            /*
             * Prune backup files from storage after x seconds
             *
             * default 0 (disabled)
             */
            // 'prune_max_ttl'   => 0,
        ],
    ],
];    

```

### Mysqldump options

The `mysql_dumper` must be an array see [Mysqldump's dump settings](https://github.com/ifsnop/mysqldump-php#dump-settings) for details.

```
return [
    'bsb_flysystem_mysql_backup' => [
        'mysql_dumper' => [
            'include_tables'        => [],
            'exclude_tables'        => [],
            'compress'              => Mysqldump::GZIP,
            'no_data'               => false,
            'add_drop_table'        => true,
            'single_transaction'    => true,
            'lock_tables'           => true,
            'add_locks'             => true,
            'extended_insert'       => false,
            'complete_insert'       => false,
            'disable_keys'          => true,
            'where'                 => '',
            'no_create_info'        => false,
            'skip_triggers'         => false,
            'add_drop_trigger'      => true,
            'routines'              => false,
            'hex_blob'              => true,
            'databases'             => false,
            'add_drop_database'     => false,
            'skip_tz_utc'           => false,
            'no_autocommit'         => true,
            'default_character_set' => Mysqldump::UTF8,
            'skip_comments'         => false,
            'skip_dump_date'        => false,
        ],
    ],
];    
```

### A Factory for a Flysystem filesystem

```
<?php

namespace MyNamespace\Container;

use Aws\S3\S3Client;
use Interop\Container\ContainerInterface;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;
use Zend\Stdlib\ArrayUtils;

class FilesystemFactory
{
    /**
     * @param ContainerInterface $container
     * @return Filesystem
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['mysql_backup_to_s3'];

        $client = new S3Client([
            'credentials' => $config['credentials'],
            'region'      => $config['region'],
            // frankfurt
            'version'     => $config['version'],
            // or latest, but not recommended in production
        ]);

        $adapter    = new AwsS3Adapter($client, $config['bucket']);
        $filesystem = new Filesystem($adapter);

        return $filesystem;
    }
}
```