<?php

namespace AndrewAndante\DIFizzBuzz;

class Processor
{
    public static function exec($end, $start)
    {
        // noop
    }

    protected static function log($message)
    {
        if (PHP_SAPI == 'cli') {
            echo $message . PHP_EOL;
        } else {
            echo $message . '<br>';
        }
    }

}