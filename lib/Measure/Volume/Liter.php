<?php
/**
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure\Volume;
use Measure\Unit;
class Liter extends Unit
{
    const NAME = 'liter';
    const RATE = 1000;

    protected $fastRates = array(
        Milliliter::NAME => 1000
    );

}
