#!/usr/bin/env php
<?php

require dirname(__DIR__) . '/app/config/bootstrap.php';

exit(\lithium\console\Dispatcher::run(new \lithium\console\Request())->status);

?>