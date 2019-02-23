<?php
/**
 * Functions file 
 *
 * PHP version 5.6+
 *
 * @category Commandline
 * @package  Visualize
 * @author   Umut Işık <umutphp@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0 GPLv3
 * @link     https://gitlab.com/umutphp/visualize-gitlabci
 */
$defaultStages = array(
    "build", "test", "deploy"
);

$reservedKeywords = array(
    "image", "services", "stages", "types", "before_script",
    "after_script", "variables", "cache"
);

$defaultTag = "master";

$CIYML = ".gitlab-ci.yml";

/**
 * Get the list of jobs from config array
 *
 * @param array $array            Config array
 * @param array $reservedKeywords Reserved keywords in the YAML file
 *
 * @return array
 */
function getListOfJobs($array, $reservedKeywords)
{
    return array_filter(
        $array,
        function ($v, $k) use ($reservedKeywords) {
            return !in_array($k, $reservedKeywords) && is_array($v);
        },
        ARRAY_FILTER_USE_BOTH
    );
}

/**
 * Get the list of tags from config array
 *
 * @param array  $array      Config array
 * @param string $defaultTag Default tag name
 *
 * @return array
 */
function getTagsUsed($jobs, $defaultTag = "master") {
    $tags = array();

    foreach ($jobs as $key => $job) {
        if (!isset($job["tags"])) {
            continue;
        }

        $tags = array_merge($tags, $job["tags"]);
    }

    if (empty($tags)) {
        return array($defaultTag);
    }

    return array_unique($tags);
}

/**
 * Get the list of stages from config array
 *
 * @param array $array         Config array
 * @param array $defaultStages Array of stages
 *
 * @return array
 */
function getStages($array, $defaultStages)
{
    if (!isset($array["stages"])) {
        return $defaultStages;
    }

    if (!is_array($array["stages"])) {
        return $defaultStages;
    }

    return $array["stages"];
}

/**
 * Display the header containing stage names
 * 
 * @param integer $columnWidth    Column width in charactter count
 * @param integer $pipelineLength Pipeline lenght in character count
 * @param array   $stage          Array of the stages
 *
 * @return void 
 */
function displayPipelineHeader($columnWidth, $pipelineLength, $stages) {
    displayTableRuler($pipelineLength);
    echo "|";

    foreach ($stages as $key => $stage) {
        $preSpaceCount  = floor(($columnWidth - strlen($stage)) / 2);
        $postSpaceCount = ceil(($columnWidth - strlen($stage)) / 2);
        echo str_repeat(" ", $preSpaceCount) . "$stage" . str_repeat(" ", $postSpaceCount) . "|";
    }
    echo PHP_EOL;
    displayTableRuler($pipelineLength);
}

/**
 * Display the header containing tag name
 * 
 * @param integer $columnWidth    Column width in charactter count
 * @param integer $pipelineLength Pipeline lenght in character count
 * @param string  $tag            Tag name
 *
 * @return void 
 */
function displayTagHeader($columnWidth, $pipelineLength, $tag) {
    displayTableRuler($pipelineLength);
    echo "|";
    $spaceCount = $pipelineLength - strlen($tag) - 3;
    echo " ". strtoupper($tag) . str_repeat(" ", $spaceCount) . "|";
    echo PHP_EOL;
}

/**
 * Display the table ruler
 * 
 * @param integer $pipelineLength Pipeline lenght in character count
 *
 * @return void 
 */
function displayTableRuler($pipelineLength) {
    echo str_repeat("-", $pipelineLength) . PHP_EOL;
}
