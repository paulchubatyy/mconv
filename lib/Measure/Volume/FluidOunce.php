<?php
/**
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure\Volume;
use Measure\Unit;
class FluidOunce extends Unit
{
    const NAME = 'fluid ounce';
    const RATE = 29.5735;

    protected $fastRates = array(
        Gallon::NAME => .0078125,
        Quart::NAME => .03125,
        Pint::NAME => .0625,
    );


}
