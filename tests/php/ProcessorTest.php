<?php

namespace AndrewAndante\DIFizzBuzz\Tests;

use AndrewAndante\DIFizzBuzz\Processor;

class ProcessorTest extends \PHPUnit_Framework_TestCase
{
    public function testExec()
    {
        $expected = "one
        two
        three fizz
        four
        five buzz
        six fizz
        seven
        eight
        nine fizz
        ten buzz
        eleven
        twelve fizz
        thirteen
        forteen
        fifteen fizz buzz
        ";

        $this->assertEquals($expected, Processor::exec(1, 15));
    }
}