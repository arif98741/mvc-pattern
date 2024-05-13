<?php

namespace App\System\Exception;

use PDOException;
use Throwable;

class MvcDatabaseConnectionException extends PDOException
{
}
