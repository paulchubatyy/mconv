<?php
/**
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure\Volume;
use Measure\Unit;
class Quart extends Unit
{
    const NAME = 'quart';
    const RATE = 946.353;

    protected $fastRates = array(
        FluidOunce::NAME => 32,
        Gallon::NAME => .25,
        Pint::NAME => 2
    );
}
