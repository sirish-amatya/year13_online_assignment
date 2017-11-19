<?php
class Item
{
    /**
     * Name of the item
     * @var string
     */
    protected $name;

    /**
     * The unit price of the item
     * @var float
     */
    protected $base_amount;

    /**
     * Total tax of the item per unit
     * @var float
     */
    protected $total_tax;
    
    /**
     * Total amount of the item per unit including tax
     * @var float
     */
    protected $total_amount;
    

    public function __construct($name, $base_amount)
    {
        //Validations

        if (trim($name)=='') {
            throw new InvalidArgumentException("First argument 'name' cannot be empty!");
        }

        if (!(is_numeric($base_amount) && $base_amount > 0)) {
            throw new InvalidArgumentException("Second argument 'base_amount' expects a positive numeric value!");
        }

        $this->name = trim($name);
        $this->base_amount = $base_amount;
        $this->total_tax = 0;
        $this->total_amount = $base_amount;
    }

    /**
     * Applies relevant tax to the item
     * @param  Tax    $tax_obj Tax object (BaseTax or ImportTax object)
     */
    public function applyTax(Tax $tax_obj)
    {
        //Calculates the tax amount upto nearest 0.05
        $tax_amount = ceil($this->base_amount*$tax_obj->getTaxRate()*20)/20;
        $this->total_amount = $this->total_amount + $tax_amount;
        $this->total_tax += $tax_amount;
    }

    /**
     * Returns the total cost of the item per unit
     * @return float upto 2 decimal places
     */
    public function getTotalCost()
    {
        return number_format($this->total_amount, 2);
    }

    /**
     * Returns the total tax of the item per unit
     * @return float upto 2 decimal places
     */
    public function getTotalTax()
    {
        return number_format($this->total_tax, 2);
    }

    /**
     * Returns the base amount of the item per unit
     * @return float
     */
    public function getBaseAmount()
    {
        return $this->base_amount;
    }

    /**
     * Returns the name of the item
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
