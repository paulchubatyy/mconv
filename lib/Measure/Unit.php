<?php
/**
 * Abstract unit class.
 * Basic methods and properties.
 * @author Paul Chubatyy <xobb@citylance.biz>
 */
namespace Measure;
abstract class Unit
{
    /** @var float */
    private $quantity;

    /** @var string The measure type */
    private $type;

    /** int conversion rate the to the standard measure */
    const RATE = 1;

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
        // Simple as that
        return $this->getQuantity() / $to::RATE * $this::RATE;
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
