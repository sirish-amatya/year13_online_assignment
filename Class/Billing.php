<?php

class Billing
{
    /**
     * List of items for billing
     * @var array
     */
    protected $item_list;

    public function __construct()
    {
        $this->item_list = array();
    }
    
    /**
     * Adds item for billing
     * @param Item    $item
     * @param integer $quantity
     */
    public function addItem(Item $item, $quantity = 1)
    {
        //Using coersion to check if given string is integer or not
        if (!is_int($quantity + 0)) {
            throw new InvalidArgumentException("Second argument 'quantity' expects an integer value!");
        }

        if ($quantity <= 0) {
            throw new InvalidArgumentException("Second argument 'quantity' expects a positive integer value!");
        }
        $this->item_list[] = array($item, $quantity);
    }

    /**
     * Displays the csv for output
     */
    public function display()
    {
        //Validation to check if there is items to display
        if (empty($this->item_list)) {
            print "Nothing to display".PHP_EOL;
            return;
        }

        $grand_total = 0;
        $sales_tax = 0;
        print "Quantity, Product, Price".PHP_EOL;
        foreach ($this->item_list as $list) {
            $item = $list[0];
            $quantity = $list[1];
            $sales_tax += $quantity*$item->getTotalTax();
            $total_price = $quantity*$item->getTotalCost();
            $grand_total += $total_price;

            print "{$quantity}, {$item->getName()}, ".number_format($item->getTotalCost(), 2).PHP_EOL;
        }

        print PHP_EOL;
        print "Sales Tax: ".number_format($sales_tax, 2).PHP_EOL;
        print "Total: ".number_format($grand_total, 2);
        print PHP_EOL;
    }
}
