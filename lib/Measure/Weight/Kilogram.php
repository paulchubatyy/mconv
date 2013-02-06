<?php
/**
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure\Weight;
use Measure\Unit;
class Kilogram extends Unit
{
    const NAME = 'kilogram';
    const RATE = 1000;

    protected $fastRates = array(
        Gram::NAME => 1000,
    );
}
