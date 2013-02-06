<?php
/**
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure\Weight;
use Measure\Unit;
class Gram extends Unit
{
    const NAME = 'gram';
    const RATE = 1;

    protected $fastRates = array(
        Kilogram::NAME => .001
    );
}
