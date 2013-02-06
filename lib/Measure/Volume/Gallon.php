<?php
/**
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure\Volume;
use Measure\Unit;
class Gallon extends Unit
{
    const NAME = 'gallon';
    const RATE = 3785.41;

    protected $fastRate = array(
        FluidOunce::NAME => 128,
        Quart::NAME => 4,
        Pint::NAME => 8
    );
}
