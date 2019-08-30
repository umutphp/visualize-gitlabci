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
}
