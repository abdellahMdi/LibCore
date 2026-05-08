<?php

require_once __DIR__."/src/services/memberfcts.php";
require_once __DIR__."/config/db.php";
$conn = DB::connect();
startMember($conn);