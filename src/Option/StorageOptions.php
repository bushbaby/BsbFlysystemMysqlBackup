<?php

namespace BsbFlysystemMysqlBackup\Option;

use Zend\Stdlib\AbstractOptions;
use Zend\Stdlib\ArrayUtils;

class StorageOptions extends AbstractOptions
{
    /**
     * Container service name of the Flysystem filesystem used to persisted dumps
     *
     * @var string
     */
    private $filesystem;

    /**
     * Path within the Flysystem filesystem where dumps are persisted
     *
     * @var string
     */
    private $path = '/';

    /**
     * Store the basename of the last created backup in this file
     *
     * @var string|bool
     */
    private $writeLatest = false;

    /**
     * Prune backup files from storage after creating a backup
     *
     * @var bool
     */
    private $autoPrune = false;

    /**
     * Prune backup files from storage when there are more than x files
     *
     * @var integer
     */
    private $pruneMaxCount = 0;

    /**
     * Prune backup files from storage after x days
     *
     * @var integer
     */
    private $pruneMaxTtl = 0;

    /**
     * @return boolean
     */
    public function getAutoPrune()
    {
        return $this->autoPrune;
    }

    /**
     * @param boolean $autoPrune
     */
    public function setAutoPrune($autoPrune)
    {
        $this->autoPrune = $autoPrune;
    }

    /**
     * @return string
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * @param string $filesystem
     */
    public function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = '/' . trim($path, '/') . '/';
    }

    /**
     * @return int
     */
    public function getPruneMaxCount()
    {
        return $this->pruneMaxCount;
    }

    /**
     * @param int $pruneMaxCount
     */
    public function setPruneMaxCount($pruneMaxCount)
    {
        $this->pruneMaxCount = $pruneMaxCount;
    }

    /**
     * @return int
     */
    public function getPruneMaxTtl()
    {
        return $this->pruneMaxTtl;
    }

    /**
     * @param int $pruneMaxTtl
     */
    public function setPruneMaxTtl($pruneMaxTtl)
    {
        $this->pruneMaxTtl = $pruneMaxTtl;
    }

    /**
     * @return bool|string
     */
    public function getWriteLatest()
    {
        return $this->writeLatest;
    }

    /**
     * @param bool|string $writeLatest
     */
    public function setWriteLatest($writeLatest)
    {
        $this->writeLatest = $writeLatest;
    }
}
