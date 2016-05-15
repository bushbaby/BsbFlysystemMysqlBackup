<?php

namespace BsbFlysystemMysqlBackup\Service;

use BsbFlysystemMysqlBackup\Option\MysqlDumperOptions;
use BsbFlysystemMysqlBackup\Option\StorageOptions;
use Ifsnop\Mysqldump\Mysqldump;
use League\Flysystem\Filesystem;
use League\Flysystem\Plugin\ListFiles;
use Zend\Stdlib\ArrayUtils;

class MysqlBackupService
{

    /**
     * @var StorageOptions
     */
    private $options;

    /**
     * @var MysqlDumperOptions
     */
    private $dumperOptions;

    /**
     * @var Mysqldump
     */
    private $dumper;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * MysqlBackupService constructor.
     *
     * @param Mysqldump  $dumper
     * @param Filesystem $filesystem
     * @param array      $options
     */
    public function __construct(
        Mysqldump $dumper,
        Filesystem $filesystem,
        StorageOptions $options,
        MysqlDumperOptions $dumperOptions
    ) {
        $this->dumper        = $dumper;
        $this->filesystem    = $filesystem;
        $this->options       = $options;
        $this->dumperOptions = $dumperOptions;
    }

    /**
     * @return mixed
     */
    public function doBackup()
    {
        $date     = date('YmdHisO');
        $dumpName = trim($this->options->getPath() . $date . '.sql', '/');

        switch ($this->dumperOptions->getCompress()) {
            case Mysqldump::GZIP:
                $dumpName = $dumpName . '.gz';
                break;
            case Mysqldump::BZIP2:
                $dumpName = $dumpName . '.bz2';
                break;
        }

        $tmpFile    = tempnam(sys_get_temp_dir(), 'bsb-flysystem-mysql-backup-');
        $fileStream = fopen($tmpFile, 'rb');

        try {
            if (false === $fileStream) {
                throw new \RuntimeException("A temp file could not be created");
            }

            // start dump and backup
            $this->dumper->start($tmpFile);
            $this->filesystem->writeStream($dumpName, $fileStream);

            // write a latest file
            if ($this->options->getWriteLatest()) {
                $this->filesystem->put(
                    $this->options->getPath() . $this->options->getWriteLatest(),
                    pathinfo($dumpName, PATHINFO_BASENAME)
                );
            }

            if ($this->options->getAutoPrune()) {
                $this->pruneStorage();
            }
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        } finally {
            if (is_resource($fileStream)) {
                fclose($fileStream);
            }

            if (file_exists($tmpFile)) {
                unlink($tmpFile);
            }
        }

        return $dumpName;
    }

    /**
     * @return int
     */
    public function pruneStorage()
    {
        if (!$this->options->getPruneMaxCount() && !$this->options->getPruneMaxTtl()) {
            return 0;
        }

        // save to just add
        $this->filesystem->addPlugin(new ListFiles());

        $filesInBackup = $this->filesystem->listFiles($this->options->getPath());

        // filter latest.txt
        if ($this->options->getWriteLatest()) {
            $filesInBackup = array_filter($filesInBackup, function ($item) {
                return ($item['basename'] != $this->options->getWriteLatest());
            });
        }

        // sort on timestamp
        usort($filesInBackup, function ($item1, $item2) {
            return strcmp($item1['timestamp'], $item2['timestamp']);
        });

        $pruneCount = 0;

        // remove while count >= pruneMaxCount or timestamp < now - pruneMaxTtl
        while ($last = array_shift($filesInBackup)) {
            if ($this->options->getPruneMaxCount()) {
                if (count($filesInBackup) >= $this->options->getPruneMaxCount()) {
                    $this->filesystem->delete($last['path']);
                    $pruneCount++;
                    continue;
                }
            }

            if ($this->options->getPruneMaxTtl()) {
                if ($last['timestamp'] < (time() - $this->options->getPruneMaxTtl())) {
                    $this->filesystem->delete($last['path']);
                    $pruneCount++;
                    continue;
                }
            }
        }

        return $pruneCount;
    }
}
