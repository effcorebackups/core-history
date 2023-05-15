<?php

##################################################################
### Copyright © 2017—2023 Maxim Rysevets. All rights reserved. ###
##################################################################

if (version_compare(PHP_VERSION, '7.1.0', '>=') !== true) {
    print 'Requires PHP version 7.1.0 or higher! The current version is '.PHP_VERSION;
    exit();
}

require_once('system/boot_initialization.php');
require_once('system/boot_web.php');
