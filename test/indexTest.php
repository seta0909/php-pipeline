<?php
require __DIR__ . "/../index.php";

use App\Pipeline;
use PHPUnit\Framework\TestCase;
use \TypeError;

class HelloTest extends TestCase
{
    function testPipeline()
    {
        $value = 1;
        $increment = function (int $value) {
            return $value + 1;
        };
        $result = Pipeline::run($value, $increment);
        $this->assertEquals($result, 2);
    }

    function testPipelineNegative()
    {
        $value = -10;
        $increment = function (int $value) {
            return $value + 1;
        };
        $result = Pipeline::run($value, $increment);
        $this->assertEquals($result, -9);
    }

    function testPipelineWhenValueIsFloat()
    {
        $value = 1.5656;
        $increment = function (int $value) {
            return $value + 1;
        };
        $result = Pipeline::run($value, $increment);
        $this->assertEquals($result, 2);
    }

    function testPipelineWhenValueIsString()
    {
        $this->expectException(TypeError::class);
        $value = 'xaabd';
        $increment = function (int $value) {
            return $value + 1;
        };
        $result = Pipeline::run($value, $increment);
        $this->assertEquals($result, 2);
    }

    function testPipelineWhenValueIsArray()
    {
        $this->expectException(TypeError::class);
        $value = [];
        $increment = function (int $value) {
            return $value + 1;
        };
        $result = Pipeline::run($value, $increment);
        $this->assertEquals($result, 2);
    }
}
