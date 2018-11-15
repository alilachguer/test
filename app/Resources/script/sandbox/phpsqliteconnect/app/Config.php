<?php

namespace App;


class Config
{
    /**
     * path to the sqlite file
     */
    const PATH_TO_SQLITE_FILE = '/work/HMIN302/sandbox/phpsqliteconnect/db/jdmapi.db';

    const MYSQL_DATABASE_NAME = 'jdmapi';
    const MYSQL_USER = 'jdmapi';
    const MYSQL_PASSWORD = 'jdmapi';
    const MYSQL_DSN = "mysql:dbname=" . self::MYSQL_DATABASE_NAME . ";host=localhost";
}