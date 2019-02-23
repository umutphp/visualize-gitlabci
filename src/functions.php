<?php
$defaultStages = array(
    "build", "test", "deploy"
);

$reservedKeywords = array(
    "image", "services", "stages", "types", "before_script",
    "after_script", "variables", "cache"
);

$CIYML = ".gitlab-ci.yml";

function getListOfJobs($array, $reservedKeywords) {
    return array_filter($array, function($v, $k) use ($reservedKeywords) {
        return !in_array($k, $reservedKeywords) && is_array($v);
    }, ARRAY_FILTER_USE_BOTH);
}

function getStages($array, $defaultStages) {
    if (!isset($array["stages"])) {
        return $defaultStages;
    }

    if (!is_array($array["stages"])) {
        return $defaultStages;
    }

    return $array["stages"];
}
