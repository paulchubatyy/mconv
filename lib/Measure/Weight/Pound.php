<?php
/**
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure\Weight;
use Measure\Unit;
class Pound extends Unit
{
    const NAME = 'pound';
    const RATE = 453.592;

    protected $fastRates = array(
        Ounce::NAME => 16,
    );
}
