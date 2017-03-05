<?php

declare(strict_types = 1);
namespace BsbFlysystemMysqlBackup\Container;

use BsbFlysystemMysqlBackup\Option\MysqlDumperOptions;
use BsbFlysystemMysqlBackup\Service\MysqlDumperService;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;
use Psr\Container\ContainerInterface;

class MysqlDumperServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return MysqlDumperService
     */
    public function __invoke(ContainerInterface $container): MysqlDumperService
    {
        $config           = $container->get('config');
        $connectionParams = null;

        if (isset($config['bsb_flysystem_mysql_backup']['connection'])) {
            $connectionParams = $config['bsb_flysystem_mysql_backup']['connection'];
        }

        // use a doctrine connection array
        if (is_array($connectionParams)) {
            $connectionParams = $this->constructDumperConnection($connectionParams);
        }

        // use a doctrine connection name
        if (is_string($connectionParams)) {
            /** @var ManagerRegistry $managerRegistry */
            $managerRegistry = $container->get(ManagerRegistry::class);
            /** @var Connection $connection */
            $connection       = $managerRegistry->getConnection($connectionParams);
            $connectionParams = $this->constructDumperConnection($connection->getParams());
        }

        /** @var MysqlDumperOptions $dumperOptions */
        $dumperOptions = $container->get(MysqlDumperOptions::class);

        return new MysqlDumperService(
            $connectionParams['dsn'],
            $connectionParams['user'],
            $connectionParams['password'],
            $dumperOptions,
            $connectionParams['driverOptions']
        );
    }

    /**
     * @param array $params
     * @return array
     */
    private function constructDumperConnection(array $params)
    {
        $result                  = [];
        $result['dsn']           = $this->constructPdoDsn($params);
        $result['user']          = $params['user'];
        $result['password']      = $params['password'];
        $result['driverOptions'] = isset($params['driverOptions']) ? $params['driverOptions'] : [];

        return $result;
    }

    /**
     * Constructs the MySql PDO DSN.
     *
     * @param array $params
     *
     * @return string The DSN.
     */
    private function constructPdoDsn(array $params)
    {
        $dsn = 'mysql:';
        if (isset($params['host']) && $params['host'] !== '') {
            $dsn .= 'host=' . $params['host'] . ';';
        }
        if (isset($params['port'])) {
            $dsn .= 'port=' . $params['port'] . ';';
        }
        if (isset($params['dbname'])) {
            $dsn .= 'dbname=' . $params['dbname'] . ';';
        }
        if (isset($params['unix_socket'])) {
            $dsn .= 'unix_socket=' . $params['unix_socket'] . ';';
        }
        if (isset($params['charset'])) {
            $dsn .= 'charset=' . $params['charset'] . ';';
        }

        return trim($dsn, ';');
    }
}
