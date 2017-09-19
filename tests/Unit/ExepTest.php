<?php
namespace tests\Unit;

use \PHPUnit\Framework\TestCase;
use src\Calculator;
use src\Commands\DivCommand;
use src\Commands\MultCommand;
use src\Commands\SumCommand;
use src\Commands\SubCommand;

class ExepTest extends TestCase
{
    protected $calc;
    public function setUp()
    {
        parent::setUp();
        $this->calc = new Calculator();
    }

    public function testComputeMethod() {
        $this->expectException(\InvalidArgumentException::class);
        $this->calc->setValue(5)->compute(' ', 5)->getResult();
    }

    public function testAddCommandMethod() {
        $this->expectException(\InvalidArgumentException::class);
        $this->calc->addCommand(5, new SumCommand());
    }

    public function testSumCommandEx()
    {
        $this->calc->addCommand('+', new SumCommand());
        $this->expectException(\InvalidArgumentException::class);
        $this->calc->setValue(5)->compute('+')->getResult();
    }

    public function testDivCommandEx()
    {
        $this->calc->addCommand('/', new DivCommand());
        $this->expectException(\InvalidArgumentException::class);
        $this->calc->setValue(5)->compute('/')->getResult();
    }

    public function testMultCommandEx()
    {
        $this->calc->addCommand('*', new MultCommand());
        $this->expectException(\InvalidArgumentException::class);
        $this->calc->setValue(5)->compute('*')->getResult();
    }

    public function testSubCommandEx()
    {
        $this->calc->addCommand('-', new SubCommand());
        $this->expectException(\InvalidArgumentException::class);
        $this->calc->setValue(10)->compute('-')->getResult();
    }
}