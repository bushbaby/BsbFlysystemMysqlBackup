<?php

namespace BsbFlysystemMysqlBackup\Container;

use BsbFlysystemMysqlBackup\Option\MysqlDumperOptions;
use BsbFlysystemMysqlBackup\Option\StorageOptions;
use BsbFlysystemMysqlBackup\Service\MysqlBackupService;
use BsbFlysystemMysqlBackup\Service\MysqlDumperService;
use Ifsnop\Mysqldump\Mysqldump as Dumper;
use Interop\Container\ContainerInterface;
use League\Flysystem\Filesystem;
use Zend\Stdlib\ArrayUtils;

class MysqlBackupServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return MysqlBackupService
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var Dumper $dumper */
        $dumper = $container->get(MysqlDumperService::class);

        /** @var StorageOptions $storageOptions */
        $storageOptions = $container->get(StorageOptions::class);

        /** @var MysqlDumperOptions $dumperOptions */
        $dumperOptions = $container->get(MysqlDumperOptions::class);

        /** @var Filesystem $filesystem */
        $filesystem = $container->get($storageOptions->getFilesystem());

        return new MysqlBackupService($dumper, $filesystem, $storageOptions, $dumperOptions);
    }
}
