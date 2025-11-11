<?php

/*
 *---------------------------------------------------------------
 * CHECK PHP VERSION
 *---------------------------------------------------------------
 */

$minPhpVersion = '8.1'; // If you update this, don't forget to update `spark`.
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Your PHP version must be %s or higher to run CodeIgniter. Current version: %s',
        $minPhpVersion,
        PHP_VERSION,
    );

    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo $message;

    exit(1);
}

/*
 *---------------------------------------------------------------
 * SET THE CURRENT DIRECTORY
 *---------------------------------------------------------------
 */

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

/*
 *---------------------------------------------------------------
 * BLOCK ACCESS TO SENSITIVE FILES
 *---------------------------------------------------------------
 */
$forbiddenExtensions = ['csv', 'txt', 'md', 'yml', 'json', 'lock', 'env'];
$forbiddenFiles = ['.htaccess', 'error_log', 'LICENSE'];

$requestUri = $_SERVER['REQUEST_URI'];
$pathInfo = pathinfo($requestUri);
$basename = basename($requestUri);

// Block by file extension
if (isset($pathInfo['extension']) && in_array($pathInfo['extension'], $forbiddenExtensions)) {
    http_response_code(403);
    exit('Access denied.');
}

// Block specific files
if (in_array($basename, $forbiddenFiles)) {
    http_response_code(403);
    exit('Access denied.');
}


header("X-Frame-Options: SAMEORIGIN");

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * our autoloader, along with Composer's, loads our constants
 * and fires up an environment-specific bootstrapping.
 */

// LOAD OUR PATHS CONFIG FILE
// This is the line that might need to be changed, depending on your folder structure.
require FCPATH . '../app/Config/Paths.php';
// ^^^ Change this line if you move your application folder

$paths = new Config\Paths();

// LOAD THE FRAMEWORK BOOTSTRAP FILE
require $paths->systemDirectory . '/Boot.php';

exit(CodeIgniter\Boot::bootWeb($paths));
