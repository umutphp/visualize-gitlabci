<?php
use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    public function testMaxJobNameLength() {
        $jobs = array(
            "job1" => array(),
            "job2" => array(),
            "1234567890" => array()
        );

        $this->assertEquals(10, maxJobNameLength($jobs));
    }

    public function testGetStages() {
        $array = array(

        );
        $defaultStages = array('defaultstages');
        
        $this->assertEquals($defaultStages, getStages($array, $defaultStages));

        $array = array(
            "stages" => "notanarray"
        );
        $defaultStages = array('defaultstages');
        
        $this->assertEquals($defaultStages, getStages($array, $defaultStages));

        $array = array(
            "stages" => array(
                "stage1", "stage2", "stage3"
            )
        );
        $defaultStages = array('defaultstages');
        
        $this->assertEquals($array["stages"], getStages($array, $defaultStages));
    }

    function testGetBranchesUsed() {
        $this->assertEquals(array("master"), getBranchesUsed(array()));

        $jobs = array(
            "job1" => array(
                "only" => array("branch1")
            )
        );
        $this->assertEquals(array("branch1"), getBranchesUsed($jobs));

        $jobs = array(
            "job1" => array(
                "only" => array("branch1", "branch2")
            ),
            "job2" => array(
                "only" => array("branch2", "branch3")
            )
        );
        $this->assertEquals(array("branch1","branch2", "branch3"), getBranchesUsed($jobs));
    }

    function testGetListOfJobs() {
        $config = array(
            "job1" => array(
                "only" => array("branch1")
            )
        );
        $this->assertEquals(array(), getListOfJobs($config, array("job1")));
        $this->assertEquals(array("job1"), array_keys(getListOfJobs($config, array("job2"))));

        $config = array(
            "job1" => array(
                "only" => array("branch1")
            ),
            "job2" => array(
                "only" => array("branch1")
            )
        );
        $this->assertEquals(array("job1"), array_keys(getListOfJobs($config, array("job2"))));
    }
}
