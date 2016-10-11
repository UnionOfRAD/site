#!/usr/bin/env php
<?php

$projectPath = dirname(__DIR__);

// Tighten security, by dropping privileges and using a private temporary directory. We
// cannot use sys_temp_dir as it can only be set inside the system configuration.
// sys_get_temp_dir() will however pick up the TMPDIR env variable.
putenv('TMPDIR=' . $projectPath . '/tmp');
ini_set('upload_tmp_dir', $projectPath . '/tmp');
ini_set('open_basedir', $projectPath . ':/dev/urandom');


require $projectPath . '/app/config/bootstrap.php';

exit(\lithium\console\Dispatcher::run(new \lithium\console\Request())->status);

?>