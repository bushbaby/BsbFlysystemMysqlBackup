<?php

namespace BsbFlysystemMysqlBackup\Container;

use BsbFlysystemMysqlBackup\Option\StorageOptions;
use Interop\Container\ContainerInterface;
use Zend\Stdlib\ArrayUtils;

class StorageOptionsFactory
{
    /**
     * @param ContainerInterface $container
     * @return StorageOptions
     */
    public function __invoke(ContainerInterface $container)
    {
        $config  = $container->get('config');
        $options = [];

        if (isset($config['bsb_flysystem_mysql_backup']['storage'])) {
            $options = $config['bsb_flysystem_mysql_backup']['storage'];
        }

        return new StorageOptions($options);
    }
}
