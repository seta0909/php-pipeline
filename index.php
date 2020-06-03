<?php
namespace App;

class Pipeline
{
    public static function run(int $value)
    {
        $args = func_get_args();

        foreach ($args as $key => $arg) {
            if ($key === 0) {
                continue;
            }
            $value = $arg($value);
        }
        return $value;
    }
}
