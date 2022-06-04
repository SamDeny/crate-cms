<?php

/**
 * Require Autoloader
 * ---
 * Composer's autoloader ensures that all required dependencies / vendors are 
 * loaded and available within the Request runtime. The only requirement is to 
 * load composer's autoloader script.
 */
require_once __DIR__ . '/../vendor/autoload.php';


/**
 * Bootstrap Application
 * ---
 * Now we need to bootstrap our Crate application using the core bootstrap file. 
 * This file will instantiate and setup the whole Application envrionment and 
 * allows you to use Crate as you please.
 */
require_once __DIR__ . '/../crate/bootstrap.php';


/**
 * Run the Application
 * ---
 * After our bootstrap code has been executed, we can now finally run the 
 * Application, process the incoming Request, perform some awesome stuff and 
 * return a neat response... or awkward error message... 
 */
$crate->run();
