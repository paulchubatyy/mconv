<?php
/**
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure\Weight;
use Measure\Unit;
class Ounce extends Unit
{
    const NAME = 'ounce';
    const RATE = 28.3495;

    protected $fastRates = array(
        Pound::NAME => .0625
    );
}
