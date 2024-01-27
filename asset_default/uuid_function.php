<?php
require_once '../vendor/autoload.php';

use Ramsey\Uuid\Uuid;

function get_uuid()
{
    $uuid = Uuid::uuid4();
    return $uuid->toString();
}
