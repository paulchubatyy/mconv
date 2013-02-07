<?php
namespace Measure;
use Codeception\Util\Stub;
class ConverterCest
{
    public $class = 'Measure\Converter';

    protected $tests = array(
        array(12, 'lb', 'oz', 192),
        array(2.5, 'kg', 'g', 2500),
        array(3, 'l', 'ml', 3000),
        array(29.5735, 'ml', 'fl oz', 1),
        array(.98, 'fl oz', 'gal', .007),
        array(1, 'pc', 'piece', 1),
    );

    // Test for Converter.convert
    public function convert(\CodeGuy $I)
    {
        $I->wantTo("test the conversion of different units");
        $I->haveStub($converter = Stub::make($this->class));
        $I->amTestingMethod('\Measure\Converter.setPrecision');
        $I->executeTestedMethodOn($converter, 3);
        $I->seeResultIs(get_class($converter));
        $I->amTestingMethod('\Measure\Converter.getPrecision');
        $I->executeTestedMethodOn($converter);
        $I->seeResultEquals(3);
        foreach ($this->tests as $values) {
            list($quantity, $from, $to, $result) = $values;
            $I->amTestingMethod('\Measure\Converter.convert');
            $I->executeTestedMethodOn($converter, $quantity, $from, $to);
            $I->seeResultEquals(round($result, $converter->getPrecision()));
            $I->executeTestedMethodOn($converter, $result, $to, $from);
            $I->seeResultEquals(round($quantity, $converter->getPrecision()));
        }
    }
    // Another test for Converter.convert
    public function convertWithException(\CodeGuy $I)
    {
        $I->wantTo("test if converting of different measure types fails.");
        $I->haveStub($converter = Stub::make($this->class));
        $I->amTestingMethod('\Measure\Converter.convert');
        $I->executeTestedMethodOn($converter, 1, 'liter', 'kg');
        $I->seeExceptionThrown('\ErrorException');
    }
}
