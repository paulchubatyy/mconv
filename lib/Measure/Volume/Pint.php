<?php
/**
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure\Volume;
use Measure\Unit;
class Pint extends Unit
{
    const NAME = 'pint';
    const RATE = 473.176;

    protected $fastRates = array(
        Gallon::NAME => .125,
        Quart::NAME => .5,
        FluidOunce::NAME => 16
    );
}
