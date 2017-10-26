<?php
/**
 * Created by PhpStorm.
 * User: prototype
 * Date: 26.10.17
 * Time: 11:07
 */

use FluentPDO;

/**
 * @note Generates database adapter
 *
 * Class DatabaseFactory
 */
class DatabaseFactory
{
    /** @note Route to the configuration file  */
    CONST databaseConfigFile = __DIR__ . '/../config/database.config.php';

    /**
     * @note Returns database adapter
     * @return \FluentPDO
     */
    public static function getDbAdapter()
    {
        try {

            $databaseData = require_once self::databaseConfigFile;

            if (!empty($databaseData) && isset($databaseData['dsn']) && isset($databaseData['user']))
            {
                $pdo = new PDO($databaseData['dsn'], $databaseData['user'], $databaseData['password']);

                return new FluentPDO($pdo);
            }

        } catch(\Exception $e)
        {
            print 'Unable to read config data and generate adapter';
        }
    }
}