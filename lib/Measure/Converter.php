<?php
/**
 * This is a measure converted utility class.
 *
 * Usage:
 *
 *      $converter = new \Measure\Converter;
 *      echo $converter->convert(12, 'pound', 'oz'); // will output amount of ounces that are equivalent to 12 pounds
 *
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure;
class Converter
{
    /**
     * @var array Acronyms that define the units.
     * TODO: This should become dynamic some time
     */
    private $acronyms = array(
        'ounce' => array('oz', 'ounce'),
        'pound' => array('lbs', 'pound', 'lb'),
        'gram' => array('gram', 'g'),
        'kilogram' => array('kg', 'kilo', 'kilogram'),
        'fluidOunce' => array('fl oz', 'floz', 'fluid ounce'),
        'gallon' => array('gal', 'gallon'),
        'liter' => array('l', 'liter'),
        'milliliter' => array('ml', 'milliliter'),
        'pint' => array('pt', 'pint'),
        'quart' => array('qt', 'quart'),
        'piece' => array('pc', 'pieces', 'piece'),
    );

    /**
     * @var array Types of measures
     * TODO: This should become dynamic some time
     */
    private $types = array(
        'volume' => array('fluidOunce', 'gallon', 'liter', 'milliliter', 'pint', 'quart'),
        'weight' => array('gram', 'kilogram', 'ounce', 'pound'),
        'piece' => array('piece'),
    );

    /** @var int precision when converting */
    private $precision = 2;

    /** @var array Simple cache of unit objects */
    private $unitCache = array();

    public function __construct($precision = null)
    {
        if (!is_null($precision))
            $this->setPrecision($precision);
    }

    /**
     * @param int $precision
     * @return Converter
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;
        return $this;
    }

    /**
     * Get the precision of the converter.
     * @return int
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * Convert one unit to another
     * @param int $quantity
     * @param string $from
     * @param string $to
     * @return float
     * @throws \ErrorException
     */
    public function convert($quantity, $from, $to)
    {
        /** @var $from Unit */
        $from = $this->getUnit($from);
        /** @var $to Unit */
        $to = $this->getUnit($to);
        return $from->setPrecision($this->precision)
            ->setQuantity($quantity)
            ->convertTo($to);
    }


    /**
     * Get the unit object.
     * @param $acronym
     * @return Unit
     * @throws \ErrorException
     */
    protected function getUnit($acronym)
    {
        $acronym = strtolower($acronym);
        $unit = null;
        foreach ($this->acronyms as $unitName => $acronyms) {
            if (in_array($acronym, $acronyms)) {
                $unit = $unitName;
                break;
            }
        }
        if (is_null($unit)) {
            throw new \ErrorException("I don't know how to work with {$acronym}");
        }

        if (array_key_exists($unit, $this->unitCache)) {
            return $this->unitCache[$unit];
        }

        $type = null;
        foreach ($this->types as $typeName => $units) {
            if (in_array($unit, $units)) {
                $type = $typeName;
                break;
            }
        }
        if (is_null($type)) {
            throw new \ErrorException("Unknown unit type for {$acronym}");
        }
        $type = ucfirst($type);
        $unit = ucfirst($unit);

        $className = "\\Measure\\{$type}\\{$unit}";
        $this->unitCache[lcfirst($unit)] = new $className;
        return $this->unitCache[lcfirst($unit)];
    }
}
