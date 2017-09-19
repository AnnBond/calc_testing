<?php
namespace tests\Unit;

use \PHPUnit\Framework\TestCase;
use src\Calculator;
use src\Commands\DivCommand;
use src\Commands\MultCommand;
use src\Commands\SumCommand;
use src\Commands\SubCommand;

class CalculatorTest extends TestCase
{
    protected $calc;
    public function setUp()
    {
        parent::setUp();
        $this->calc = new Calculator();

        $sumMock = $this->createMock(SumCommand::class);
        $sumMock->method('execute')->willReturn(10);
        $this->calc->addCommand('+', $sumMock);

        $subMock = $this->createMock(SubCommand::class);
        $subMock->method('execute')->willReturn(5);
        $this->calc->addCommand('-', $subMock);

        $subMock = $this->createMock(DivCommand::class);
        $subMock->method('execute')->willReturn(5);
        $this->calc->addCommand('/', $subMock);

        $subMock = $this->createMock(MultCommand::class);
        $subMock->method('execute')->willReturn(4);
        $this->calc->addCommand('*', $subMock);
    }

    public function testSub() {
        $sum = new SubCommand();
        $result = $sum->execute(10, 5);
        $this->assertEquals(5, $result);
    }

    public function testSum() {
        $sum = new SumCommand();
        $result = $sum->execute(5, 5);
        $this->assertEquals(10, $result);
    }

    public function testDiv() {
        $sum = new DivCommand();
        $result = $sum->execute(10, 5);
        $this->assertEquals(2, $result);
    }

    public function testMult() {
        $sum = new MultCommand();
        $result = $sum->execute(5, 5);
        $this->assertEquals(25, $result);
    }

    public function testMethod() {
        $result = $this->calc->setValue(5)->getResult();
        $this->assertEquals(5, $result);
    }

    public function testSumCommand()
    {
        $result = $this->calc->setValue(5)->compute('+', 5)->getResult();
        $this->assertEquals(10, $result);
    }

    public function testDivCommand()
    {
        $result = $this->calc->setValue(10)->compute('/', 2)->getResult();
        $this->assertEquals(5, $result);
    }

    public function testMultCommand()
    {
        $result = $this->calc->setValue(2)->compute('*', 2)->getResult();
        $this->assertEquals(4, $result);
    }

    public function testSubCommand()
    {
        $result = $this->calc->setValue(10)->compute('-', 5)->getResult();
        $this->assertEquals(5, $result);
    }

    public function testUndoMethod()
    {
        $result = $this->calc->setValue(5)->compute('+', 5)->getResult();
        $this->assertEquals(10, $result);

        $result = $this->calc->undo()->getResult();
        $this->assertEquals(5, $result);
    }
}