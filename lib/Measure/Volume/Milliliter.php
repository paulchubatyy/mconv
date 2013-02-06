<?php
/**
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure\Volume;
use Measure\Unit;
class Milliliter extends Unit
{
    const NAME = 'milliliter';
    const RATE = 1;

    protected $fastRates = array(
        Liter::NAME => .001,
    );
}
