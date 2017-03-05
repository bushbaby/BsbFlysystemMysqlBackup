<?php

declare(strict_types = 1);

namespace BsbFlysystemMysqlBackup\Container;

use BsbFlysystemMysqlBackup\Option\MysqlDumperOptions;
use Psr\Container\ContainerInterface;

class MysqlDumperOptionsFactory
{
    public function __invoke(ContainerInterface $container): MysqlDumperOptions
    {
        $config  = $container->get('config');
        $options = [];

        if (isset($config['bsb_flysystem_mysql_backup']['mysql_dumper'])) {
            $options = $config['bsb_flysystem_mysql_backup']['mysql_dumper'];
        }

        return new MysqlDumperOptions($options);
    }
}
