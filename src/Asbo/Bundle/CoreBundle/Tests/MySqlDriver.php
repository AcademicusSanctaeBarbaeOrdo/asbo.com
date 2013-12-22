<?php

namespace Asbo\Bundle\CoreBundle\Tests;

use Doctrine\DBAL\Driver\PDOMySql\Driver;

/**
 * This file comes from Sylius package.
 *
 * @see https://github.com/Sylius/SyliusCoreBundle/blob/master/Tests/MySqlDriver.php
 */
class MySqlDriver extends Driver
{
    private static $connection;

    public function connect(array $params, $username = null, $password = null, array $driverOptions = [])
    {
        if (null === self::$connection) {
            self::$connection = parent::connect($params, $username, $password, $driverOptions);
        }

        return self::$connection;
    }
}
