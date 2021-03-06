<?php

declare(strict_types=1);

namespace AndrewAndante\DIFizzBuzz;

class Processor
{
    /**
     * Primary execution class.
     *
     * Will return an array of spelled-out numbers, with the following appended:
     *   - if the integer is divisible by 3, it will have "fizz" appended
     *   - if the integer is divisible by 5, it will have "buzz" appended
     *
     * If the $log parameter is passed as true, the output will be echoed as well as returned
     *
     * @param   int   $start  First number to process
     * @param   int   $end    Last number to process
     * @param   bool  $log    Whether or not to log the output
     *
     * @return  string[]
     */
    public static function exec(int $start, int $end, bool $log = false) : array
    {
        self::validate($start);
        self::validate($end);

        $smallest = min($start, $end);
        $largest = max($start, $end);

        $output = [];

        // transform the raw integer into the equivalent English words e.g. 1 => one
        $formatter = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);

        for ($i = $smallest; $i <= $largest; ++$i) {
            $string = $formatter->format($i);
            $string .= ($i % 3 == 0) ? " fizz" : "";
            $string .= ($i % 5 == 0) ? " buzz" : "";

            $output[] = $string;
        }

        // if we are counting down rather than up, we need to turn the array around
        if ($smallest !== $start) {
            $output = array_reverse($output);
        }

        if ($log) {
            foreach ($output as $line) {
                self::log($line);
            }
        }

        return $output;
    }

    /**
     * Helper method for most common use-case of exec (start at 1)
     *
     * @param   int   $end    Last number to process
     * @param   bool  $log    Whether or not to log the output
     *
     * @return  string[]
     */
    public static function execTo(int $end, bool $log = false) : array
    {
        return self::exec(1, $end, $log);
    }


    /**
     * Validate that our start and end are between 1 and 100
     *
     * @param   int $integer
     *
     * @throws  \InvalidArgumentException
     */
    public static function validate(int $integer)
    {
       if ($integer > 100 || $integer < 1) {
           throw new \InvalidArgumentException('Value passed must be between 1 and 100');
       }
    }

    /**
     * Helper method to log appropriately for viewing method
     *
     * @param string $message
     */
    protected static function log(string $message)
    {
        if (PHP_SAPI == 'cli') {
            echo $message . PHP_EOL;
        } else {
            echo $message . '<br>';
        }
    }

}