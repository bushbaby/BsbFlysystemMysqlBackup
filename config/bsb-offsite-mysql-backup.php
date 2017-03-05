<?php

declare(strict_types=1);
use Ifsnop\Mysqldump\Mysqldump;

return [
    'bsb_flysystem_mysql_backup' => [
        /*
         * Either a doctrine connection name or an array with doctrine connection parameters
         */
        'connection' => [
            'host'          => 'localhost',
            'user'          => 'dbuser',
            'password'      => 'dbpass',
            'dbname'        => 'dbname',
            'charset'       => 'utf8',
            'driverOptions' => [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            ],
        ],

        'storage' => [
            /*
             * Container service name of the Flysystem filesystem used to persisted dumps
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
            'disable_keys'          => true,
            'where'                 => '',
            'no_create_info'        => false,
            'skip_triggers'         => false,
            'add_drop_trigger'      => true,
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
