<?php

declare(strict_types=1);

namespace AndrewAndante\DIFizzBuzz;

class Processor
{
    /**
     * Primary execution class.
     *
     * @param int   $start  First number to process
     * @param int   $end    Last number to process
     * @param bool  $log    Whether or not to log the output
     *
     * @return string[]
     */
    public static function exec(int $start, int $end, bool $log = false) : array
    {
        self::validate($start);
        self::validate($end);

        $output = [];
        $formatter = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        for ($i = $start; $i <= $end; ++$i)
        {
            $string = $formatter->format($i);
            $string .= ($i % 3 == 0) ? " fizz" : "";
            $string .= ($i % 5 == 0) ? " buzz" : "";

            if ($log) {
                self::log($string);
            }

            $output[] = $string;
        }

        return $output;
    }

    /**
     * Helper method for most common use-case (start at 1)
     *
     * @param int   $end    Last number to process
     * @param bool  $log    Whether or not to log the output
     *
     * @return string[]
     */
    public static function execTo(int $end, bool $log = false) : array
    {
        return self::exec(1, $end, $log);
    }


    /**
     * Validate that our start and end are between 1 and 100
     *
     * @param int $integer
     *
     * @throws \InvalidArgumentException
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