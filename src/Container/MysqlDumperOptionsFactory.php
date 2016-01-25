<?php

namespace BsbFlysystemMysqlBackup\Container;

use Interop\Container\ContainerInterface;
use BsbFlysystemMysqlBackup\Option\MysqlDumperOptions;
use Zend\Stdlib\ArrayUtils;

class MysqlDumperOptionsFactory
{
    /**
     * @param ContainerInterface $container
     * @return MysqlDumperOptions
     */
    public function __invoke(ContainerInterface $container)
    {
        $config  = $container->get('config');
        $options = [];

        if (isset($config['bsb_flysystem_mysql_backup']['mysql_dumper'])) {
            $options = $config['bsb_flysystem_mysql_backup']['mysql_dumper'];
        }

        return new MysqlDumperOptions($options);
    }
}
