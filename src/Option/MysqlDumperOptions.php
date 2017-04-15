<?php

declare(strict_types=1);

namespace BsbFlysystemMysqlBackup\Option;

use Ifsnop\Mysqldump\Mysqldump;
use Zend\Stdlib\AbstractOptions;

class MysqlDumperOptions extends AbstractOptions
{
    private $includeTables       = [];
    private $excludeTables       = [];
    private $compress            = Mysqldump::GZIP;
    private $noData              = false;
    private $addDropTable        = true;
    private $singleTransaction   = true;
    private $lockTables          = true;
    private $addLocks            = true;
    private $extendedInsert      = false;
    private $disableKeys         = true;
    private $where               = '';
    private $noCreateInfo        = false;
    private $skipTriggers        = false;
    private $addDropTrigger      = true;
    private $routines            = false;
    private $hexBlob             = true;
    private $databases           = false;
    private $addDropDatabase     = false;
    private $skipTzUtc           = false;
    private $noAutocommit        = true;
    private $defaultCharacterSet = Mysqldump::UTF8;
    private $skipComments        = false;
    private $skipDumpDate        = false;

    public function getIncludeTables(): array
    {
        return $this->includeTables;
    }

    public function setIncludeTables(array $includeTables): void
    {
        $this->includeTables = $includeTables;
    }

    public function getExcludeTables(): array
    {
        return $this->excludeTables;
    }

    public function setExcludeTables(array $excludeTables): void
    {
        $this->excludeTables = $excludeTables;
    }

    public function getCompress(): string
    {
        return $this->compress;
    }

    public function setCompress(string $compress): void
    {
        $this->compress = $compress;
    }

    public function getNoData(): bool
    {
        return $this->noData;
    }

    public function setNoData(bool $noData): void
    {
        $this->noData = $noData;
    }

    public function getAddDropTable(): bool
    {
        return $this->addDropTable;
    }

    public function setAddDropTable(bool $addDropTable): void
    {
        $this->addDropTable = $addDropTable;
    }

    public function getSingleTransaction(): bool
    {
        return $this->singleTransaction;
    }

    public function setSingleTransaction(bool $singleTransaction): void
    {
        $this->singleTransaction = $singleTransaction;
    }

    public function getLockTables(): bool
    {
        return $this->lockTables;
    }

    public function setLockTables(bool $lockTables): void
    {
        $this->lockTables = $lockTables;
    }

    public function getAddLocks(): bool
    {
        return $this->addLocks;
    }

    public function setAddLocks(bool $addLocks): void
    {
        $this->addLocks = $addLocks;
    }

    public function getExtendedInsert(): bool
    {
        return $this->extendedInsert;
    }

    public function setExtendedInsert(bool $extendedInsert): void
    {
        $this->extendedInsert = $extendedInsert;
    }

    public function getDisableKeys(): bool
    {
        return $this->disableKeys;
    }

    public function setDisableKeys(bool $disableKeys): void
    {
        $this->disableKeys = $disableKeys;
    }

    public function getWhere(): string
    {
        return $this->where;
    }

    public function setWhere(string $where): void
    {
        $this->where = $where;
    }

    public function getNoCreateInfo(): bool
    {
        return $this->noCreateInfo;
    }

    public function setNoCreateInfo(bool $noCreateInfo): void
    {
        $this->noCreateInfo = $noCreateInfo;
    }

    public function getSkipTriggers(): bool
    {
        return $this->skipTriggers;
    }

    public function setSkipTriggers(bool $skipTriggers): void
    {
        $this->skipTriggers = $skipTriggers;
    }

    public function getAddDropTrigger(): bool
    {
        return $this->addDropTrigger;
    }

    public function setAddDropTrigger(bool $addDropTrigger): void
    {
        $this->addDropTrigger = $addDropTrigger;
    }

    public function getRoutines(): bool
    {
        return $this->routines;
    }

    public function setRoutines(bool $routines): void
    {
        $this->routines = $routines;
    }

    public function getHexBlob(): bool
    {
        return $this->hexBlob;
    }

    public function setHexBlob(bool $hexBlob): void
    {
        $this->hexBlob = $hexBlob;
    }

    public function getDatabases(): bool
    {
        return $this->databases;
    }

    public function setDatabases(bool $databases): void
    {
        $this->databases = $databases;
    }

    public function getAddDropDatabase(): bool
    {
        return $this->addDropDatabase;
    }

    public function setAddDropDatabase(bool $addDropDatabase): void
    {
        $this->addDropDatabase = $addDropDatabase;
    }

    public function getSkipTzUtc(): bool
    {
        return $this->skipTzUtc;
    }

    public function setSkipTzUtc(bool $skipTzUtc): void
    {
        $this->skipTzUtc = $skipTzUtc;
    }

    public function getNoAutocommit(): bool
    {
        return $this->noAutocommit;
    }

    public function setNoAutocommit(bool $noAutocommit): void
    {
        $this->noAutocommit = $noAutocommit;
    }

    public function getDefaultCharacterSet(): string
    {
        return $this->defaultCharacterSet;
    }

    public function setDefaultCharacterSet(string $defaultCharacterSet): void
    {
        $this->defaultCharacterSet = $defaultCharacterSet;
    }

    public function getSkipComments(): bool
    {
        return $this->skipComments;
    }

    public function setSkipComments(bool $skipComments): void
    {
        $this->skipComments = $skipComments;
    }

    public function getSkipDumpDate(): bool
    {
        return $this->skipDumpDate;
    }

    public function setSkipDumpDate(bool $skipDumpDate): void
    {
        $this->skipDumpDate = $skipDumpDate;
    }

    public function toDumperArray(): array
    {
        $array     = [];
        $transform = function ($letters) {
            $letter = array_shift($letters);

            return '-' . strtolower($letter);
        };
        foreach ($this as $key => $value) {
            if ($key === '__strictMode__') {
                continue;
            }
            $normalizedKey         = preg_replace_callback('/([A-Z])/', $transform, $key);
            $array[$normalizedKey] = $value;
        }

        return $array;
    }
}
