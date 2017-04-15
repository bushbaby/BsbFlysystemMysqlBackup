<?php

declare(strict_types=1);

namespace BsbFlysystemMysqlBackup\Option;

use Zend\Stdlib\AbstractOptions;

class StorageOptions extends AbstractOptions
{
    /**
     * Container service name of the Flysystem filesystem used to persisted dumps.
     *
     * @var string
     */
    private $filesystem;

    /**
     * Path within the Flysystem filesystem where dumps are persisted.
     *
     * @var string
     */
    private $path = '/';

    /**
     * Store the basename of the last created backup in this file.
     *
     * @var string|bool
     */
    private $writeLatest = false;

    /**
     * Prune backup files from storage after creating a backup.
     *
     * @var bool
     */
    private $autoPrune = false;

    /**
     * Prune backup files from storage when there are more than x files.
     *
     * @var int
     */
    private $pruneMaxCount = 0;

    /**
     * Prune backup files from storage after x days.
     *
     * @var int
     */
    private $pruneMaxTtl = 0;

    public function getAutoPrune(): bool
    {
        return $this->autoPrune;
    }

    public function setAutoPrune(bool $autoPrune): void
    {
        $this->autoPrune = $autoPrune;
    }

    public function getFilesystem(): string
    {
        return $this->filesystem;
    }

    public function setFilesystem(string $filesystem): void
    {
        $this->filesystem = $filesystem;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = '/' . trim($path, '/') . '/';
    }

    public function getPruneMaxCount(): int
    {
        return $this->pruneMaxCount;
    }

    public function setPruneMaxCount(int $pruneMaxCount): void
    {
        $this->pruneMaxCount = $pruneMaxCount;
    }

    public function getPruneMaxTtl(): int
    {
        return $this->pruneMaxTtl;
    }

    public function setPruneMaxTtl(int $pruneMaxTtl): void
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
    public function setWriteLatest($writeLatest): void
    {
        $this->writeLatest = $writeLatest;
    }
}
