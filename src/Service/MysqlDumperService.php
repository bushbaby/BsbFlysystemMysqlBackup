<?php

declare(strict_types = 1);

namespace BsbFlysystemMysqlBackup\Service;

use BsbFlysystemMysqlBackup\Option\MysqlDumperOptions;
use Ifsnop\Mysqldump\Mysqldump;

class MysqlDumperService extends Mysqldump
{
    public function __construct(
        $dsn,
        $user,
        $pass,
        MysqlDumperOptions $dumpSettings,
        $pdoSettings = []
    ) {
        parent::__construct($dsn, $user, $pass, $dumpSettings->toDumperArray(), $pdoSettings);
    }
}
