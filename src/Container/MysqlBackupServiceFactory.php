<?php

declare(strict_types=1);

namespace BsbFlysystemMysqlBackup\Container;

use BsbFlysystem\Service\FilesystemManager;
use BsbFlysystemMysqlBackup\Option\MysqlDumperOptions;
use BsbFlysystemMysqlBackup\Option\StorageOptions;
use BsbFlysystemMysqlBackup\Service\MysqlBackupService;
use BsbFlysystemMysqlBackup\Service\MysqlDumperService;
use Ifsnop\Mysqldump\Mysqldump as Dumper;
use League\Flysystem\Filesystem;
use Psr\Container\ContainerInterface;

class MysqlBackupServiceFactory
{
    public function __invoke(ContainerInterface $container): MysqlBackupService
    {
        /** @var Dumper $dumper */
        $dumper = $container->get(MysqlDumperService::class);

        /** @var StorageOptions $storageOptions */
        $storageOptions = $container->get(StorageOptions::class);

        /** @var MysqlDumperOptions $dumperOptions */
        $dumperOptions = $container->get(MysqlDumperOptions::class);

        /* @var Filesystem $filesystem */
        if ($container->has(FilesystemManager::class)) {
            $filesystem = $container->get(FilesystemManager::class)->get($storageOptions->getFilesystem());
        } else {
            $filesystem = $container->get($storageOptions->getFilesystem());
        }

        return new MysqlBackupService($dumper, $filesystem, $storageOptions, $dumperOptions);
    }
}
