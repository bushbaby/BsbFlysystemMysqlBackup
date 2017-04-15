<?php

declare(strict_types=1);

namespace BsbFlysystemMysqlBackup\Container;

use BsbFlysystemMysqlBackup\Option\StorageOptions;
use Psr\Container\ContainerInterface;

class StorageOptionsFactory
{
    public function __invoke(ContainerInterface $container): StorageOptions
    {
        $config  = $container->get('config');
        $options = [];

        if (isset($config['bsb_flysystem_mysql_backup']['storage'])) {
            $options = $config['bsb_flysystem_mysql_backup']['storage'];
        }

        return new StorageOptions($options);
    }
}
