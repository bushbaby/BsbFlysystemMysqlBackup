<?php

declare(strict_types = 1);

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

    /**
     * @return array
     */
    public function getIncludeTables()
    {
        return $this->includeTables;
    }

    /**
     * @param array $includeTables
     */
    public function setIncludeTables($includeTables)
    {
        $this->includeTables = $includeTables;
    }

    /**
     * @return array
     */
    public function getExcludeTables()
    {
        return $this->excludeTables;
    }

    /**
     * @param array $excludeTables
     */
    public function setExcludeTables($excludeTables)
    {
        $this->excludeTables = $excludeTables;
    }

    /**
     * @return string
     */
    public function getCompress()
    {
        return $this->compress;
    }

    /**
     * @param string $compress
     */
    public function setCompress($compress)
    {
        $this->compress = $compress;
    }

    /**
     * @return boolean
     */
    public function getNoData()
    {
        return $this->noData;
    }

    /**
     * @param boolean $noData
     */
    public function setNoData($noData)
    {
        $this->noData = $noData;
    }

    /**
     * @return boolean
     */
    public function getAddDropTable()
    {
        return $this->addDropTable;
    }

    /**
     * @param boolean $addDropTable
     */
    public function setAddDropTable($addDropTable)
    {
        $this->addDropTable = $addDropTable;
    }

    /**
     * @return boolean
     */
    public function getSingleTransaction()
    {
        return $this->singleTransaction;
    }

    /**
     * @param boolean $singleTransaction
     */
    public function setSingleTransaction($singleTransaction)
    {
        $this->singleTransaction = $singleTransaction;
    }

    /**
     * @return boolean
     */
    public function getLockTables()
    {
        return $this->lockTables;
    }

    /**
     * @param boolean $lockTables
     */
    public function setLockTables($lockTables)
    {
        $this->lockTables = $lockTables;
    }

    /**
     * @return boolean
     */
    public function getAddLocks()
    {
        return $this->addLocks;
    }

    /**
     * @param boolean $addLocks
     */
    public function setAddLocks($addLocks)
    {
        $this->addLocks = $addLocks;
    }

    /**
     * @return boolean
     */
    public function getExtendedInsert()
    {
        return $this->extendedInsert;
    }

    /**
     * @param boolean $extendedInsert
     */
    public function setExtendedInsert($extendedInsert)
    {
        $this->extendedInsert = $extendedInsert;
    }

    /**
     * @return boolean
     */
    public function getDisableKeys()
    {
        return $this->disableKeys;
    }

    /**
     * @param boolean $disableKeys
     */
    public function setDisableKeys($disableKeys)
    {
        $this->disableKeys = $disableKeys;
    }

    /**
     * @return string
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * @param string $where
     */
    public function setWhere($where)
    {
        $this->where = $where;
    }

    /**
     * @return boolean
     */
    public function getNoCreateInfo()
    {
        return $this->noCreateInfo;
    }

    /**
     * @param boolean $noCreateInfo
     */
    public function setNoCreateInfo($noCreateInfo)
    {
        $this->noCreateInfo = $noCreateInfo;
    }

    /**
     * @return boolean
     */
    public function getSkipTriggers()
    {
        return $this->skipTriggers;
    }

    /**
     * @param boolean $skipTriggers
     */
    public function setSkipTriggers($skipTriggers)
    {
        $this->skipTriggers = $skipTriggers;
    }

    /**
     * @return boolean
     */
    public function getAddDropTrigger()
    {
        return $this->addDropTrigger;
    }

    /**
     * @param boolean $addDropTrigger
     */
    public function setAddDropTrigger($addDropTrigger)
    {
        $this->addDropTrigger = $addDropTrigger;
    }

    /**
     * @return boolean
     */
    public function getRoutines()
    {
        return $this->routines;
    }

    /**
     * @param boolean $routines
     */
    public function setRoutines($routines)
    {
        $this->routines = $routines;
    }

    /**
     * @return boolean
     */
    public function getHexBlob()
    {
        return $this->hexBlob;
    }

    /**
     * @param boolean $hexBlob
     */
    public function setHexBlob($hexBlob)
    {
        $this->hexBlob = $hexBlob;
    }

    /**
     * @return boolean
     */
    public function getDatabases()
    {
        return $this->databases;
    }

    /**
     * @param boolean $databases
     */
    public function setDatabases($databases)
    {
        $this->databases = $databases;
    }

    /**
     * @return boolean
     */
    public function getAddDropDatabase()
    {
        return $this->addDropDatabase;
    }

    /**
     * @param boolean $addDropDatabase
     */
    public function setAddDropDatabase($addDropDatabase)
    {
        $this->addDropDatabase = $addDropDatabase;
    }

    /**
     * @return boolean
     */
    public function getSkipTzUtc()
    {
        return $this->skipTzUtc;
    }

    /**
     * @param boolean $skipTzUtc
     */
    public function setSkipTzUtc($skipTzUtc)
    {
        $this->skipTzUtc = $skipTzUtc;
    }

    /**
     * @return boolean
     */
    public function getNoAutocommit()
    {
        return $this->noAutocommit;
    }

    /**
     * @param boolean $noAutocommit
     */
    public function setNoAutocommit($noAutocommit)
    {
        $this->noAutocommit = $noAutocommit;
    }

    /**
     * @return string
     */
    public function getDefaultCharacterSet()
    {
        return $this->defaultCharacterSet;
    }

    /**
     * @param string $defaultCharacterSet
     */
    public function setDefaultCharacterSet($defaultCharacterSet)
    {
        $this->defaultCharacterSet = $defaultCharacterSet;
    }

    /**
     * @return boolean
     */
    public function getSkipComments()
    {
        return $this->skipComments;
    }

    /**
     * @param boolean $skipComments
     */
    public function setSkipComments($skipComments)
    {
        $this->skipComments = $skipComments;
    }

    /**
     * @return boolean
     */
    public function getSkipDumpDate()
    {
        return $this->skipDumpDate;
    }

    /**
     * @param boolean $skipDumpDate
     */
    public function setSkipDumpDate($skipDumpDate)
    {
        $this->skipDumpDate = $skipDumpDate;
    }

    /**
     * Cast to array
     *
     * @return array
     */
    public function toDumperArray()
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
