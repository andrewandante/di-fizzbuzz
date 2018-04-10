<?php

declare(strict_types=1);

namespace AndrewAndante\DIFizzBuzz\Tests;

use AndrewAndante\DIFizzBuzz\Processor;

class ProcessorTest extends \PHPUnit_Framework_TestCase
{
    private $expected = [
        'one',
        'two',
        'three fizz',
        'four',
        'five buzz',
        'six fizz',
        'seven',
        'eight',
        'nine fizz',
        'ten buzz',
        'eleven',
        'twelve fizz',
        'thirteen',
        'fourteen',
        'fifteen fizz buzz',
    ];

    public function testSimpleExec()
    {
        $this->assertEquals($this->expected, Processor::exec(1, 15));
        $this->assertEquals($this->expected, Processor::execTo(15));
        $this->assertEquals(['one'], Processor::exec(1, 1));
        $this->assertEquals(['fifteen fizz buzz'], Processor::exec(15, 15));

        $headlessExpected = array_slice($this->expected, 1);
        $this->assertEquals($headlessExpected, Processor::exec(2, 15));

    }

    public function testSimpleExecWithLogging()
    {
        // add one for the trailing EOL character
        $expectedEchoes = implode(PHP_EOL, $this->expected) . PHP_EOL;

        // Capture the echo output to a variable
        ob_start();
        Processor::exec(1, 15, true);
        $output = ob_get_contents();
        ob_end_clean();

        $this->assertEquals($expectedEchoes, $output);
    }

    /**
     * @param       $from
     * @param       $to
     *
     * @dataProvider notIntegersProvider
     */
    public function testNotIntegers($from, $to)
    {
        try {
            Processor::exec($from, $to);
        } catch (\Error $error) {
            $this->assertInstanceOf(\TypeError::class, $error);
        }
    }

    public static function notIntegersProvider()
    {
        return [
            ["one", "fifteen"],
            [1.0, 15.0],
            ["1", "15"],
            ["one", 15],
            [[1], [15]]
        ];
    }

    /**
     * @dataProvider outsideRangeProvider
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Value passed must be between 1 and 100
     */
    public function testOutsideRange($start, $end)
    {
        Processor::exec($start, $end);
    }

    public static function outsideRangeProvider()
    {
        return [
            [0, 15],
            [1, 101],
            [-1, 15],
            [1, -15]
        ];
    }

}