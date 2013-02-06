<?php
/**
 * Abstract unit class.
 * Basic methods and properties.
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure;
abstract class Unit
{
    /** @var array Fast rates for conversion */
    protected $fastRates = array();

    /** @var float */
    private $quantity;

    /** @var string The measure type */
    private $type;

    private $precision = 2;

    /** string measure name */
    const NAME = 'measure name';

    /** int conversion rate the to the standard measure */
    const RATE = 1;

    /**
     * @param $precision
     * @return Unit
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * Set quantity.
     * @param $quantity
     * @return Unit
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Get quantity.
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Convert the quantity to another unit quantity
     * @param Unit $to
     * @throws \ErrorException
     * @return float
     */
    public function convertTo(Unit $to)
    {
        if ($this->getType() != $to->getType()) {
            throw new \ErrorException("Cannot convert {$this->getType()} to {$to->getType()}");
        }

        // Do we have the fast conversion rate set?
        if (array_key_exists($to::NAME, $this->fastRates)) {
            $result = $this->getQuantity() * $this->fastRates[$to::NAME];
        } else {
            // Convert through the universal standard
            $result = $this->getQuantity() / $to::RATE * $this::RATE;
        }
        return round($result, $this->getPrecision());
    }

    /**
     * Get the type of the measure.
     * @return string
     * @throws \ErrorException
     */
    public function getType()
    {
        if (!is_null($this->type)) {
            return $this->type;
        }

        $class = get_class($this);
        $parts = explode('\\', $class);
        if (count($parts) < 2) {
            throw new \ErrorException("Invalid class {$class}, cannot get it's namespace.");
        }
        array_pop($parts);
        $type = array_pop($parts);

        $this->type = strtolower($type);
        return $this->getType();
    }
}
