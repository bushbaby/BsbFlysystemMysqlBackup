<?php

namespace BsbFlysystemMysqlBackup\Service;

use BsbFlysystemMysqlBackup\Option\MysqlDumperOptions;
use Ifsnop\Mysqldump\Mysqldump;

class MysqlDumperService extends Mysqldump
{
    /**
     * MysqlDumperService constructor.
     *
     * @param string             $dsn
     * @param string             $user
     * @param string             $pass
     * @param MysqlDumperOptions $dumpSettings
     * @param array              $pdoSettings
     */
    public function __construct(
        $dsn = '',
        $user = '',
        $pass = '',
        MysqlDumperOptions $dumpSettings,
        $pdoSettings = []
    ) {
        parent::__construct($dsn, $user, $pass, $dumpSettings->toDumperArray(), $pdoSettings);
    }
}
