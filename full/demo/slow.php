<?php

define('WEBSITE_TITLE', 'Redirect When Blocked Full Edition Demo Website Slow Page');

require 'index.php';

// Simulate a slow connection.
sleep(rand(2, 6));