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
        include $file;
        $autoloadFileFound = true;
        break;
    }
}

if (!$autoloadFileFound) {
    $message = 'No autoload.php is found' .PHP_EOL;

    echo $message . PHP_EOL;
    die(FAILED);
}

require_once __DIR__ . '/src/functions.php';

$config   = Yaml::parseFile($CIYML);
$jobs     = getListOfJobs($config, $reservedKeywords);
$stages   = getStages($config, $defaultStages);
$branches = getBranchesUsed($config, $defaultTag);
$data     = getDisplayData($jobs);

$columnWidth    = 32;
$pipelineLength = (count($stages) * $columnWidth) + count($stages) + 1;

//var_dump($data);

foreach ($data as $branch => $stages) {
    displayTagHeader($columnWidth, $pipelineLength, $branch);
    displayPipelineHeader($columnWidth, $pipelineLength, array_keys($stages));

    $maxStepCount = 0;
    
    foreach ($stages as $stage => $steps) {
        if (count($steps) > $maxStepCount) {
            $maxStepCount = count($steps);
        }
    }

    for ($i=0; $i < $maxStepCount; $i++) {
        $listOfSteps = array();

        foreach ($stages as $stage => $steps) {
            if (isset($steps[$i])) {
                $listOfSteps[] = $steps[$i];
                continue;
            }

            $listOfSteps[] = array("name" => "");
        }

        displayPipelineLine($columnWidth, $pipelineLength, $listOfSteps);
    }
    displayTableRuler($pipelineLength);
    echo PHP_EOL;
}
