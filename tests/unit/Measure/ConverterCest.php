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
        array(1.22, 'ml', 'fl oz', .041253148934012),
        array(.98, 'fl oz', 'gal', .0076562459548635),
    );

    // Test for Converter.convert
    public function convert(\CodeGuy $I)
    {
        $I->wantTo("test the conversion of different unites");
        $I->haveStub($converter = Stub::make($this->class));
        foreach ($this->tests as $values) {
            list($quantity, $from, $to, $result) = $values;
            $I->executeTestedMethodOn($converter, $quantity, $from, $to);
            $I->seeResultEquals($result);
            $I->executeTestedMethodOn($converter, $result, $to, $from);
            $I->seeResultEquals($quantity);
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
