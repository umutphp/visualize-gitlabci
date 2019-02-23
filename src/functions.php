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

$CIYML = ".gitlab-ci.yml";

/**
 * Get the list of jobs from config array
 *
 * @param array $array Config array
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
 * Get the list of stages from config array
 *
 * @param array $array Config array
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
