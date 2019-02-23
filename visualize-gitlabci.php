<?php
/**
 * Visiualize the Gitlab Pipeline
 *
 * A commandline script to visiualize the Gitlab pipeline on commandline
 *
 * PHP version 5.6+
 *
 * @category Commandline
 * @package  Visualize
 * @author   Umut Işık <umutphp@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://gitlab.com/umutphp/visualize-gitlabci
 */

use Symfony\Component\Yaml\Yaml;

$files = array(
    __DIR__ . '/../../autoload.php',
    __DIR__ . '/vendor/autoload.php'
);
$autoloadFileFound = false;
foreach ($files as $file) {
    if (file_exists($file)) {
        require $file;
        $autoloadFileFound = true;
        break;
    }
}
if (!$autoloadFileFound) {
    $message = 'You need to set up the project dependencies using composer commands:' . PHP_EOL;
    fwrite(STDERR,
        $message
    );
    echo $message . PHP_EOL;
    die(FAILED);
}

require_once __DIR__ . '/src/functions.php';

$config = Yaml::parseFile($CIYML);
$jobs   = getListOfJobs($config, $reservedKeywords);
$stages = getStages($config, $defaultStages);
