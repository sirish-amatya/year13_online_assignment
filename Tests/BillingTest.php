<?php
require __DIR__.'/../Class/Item.php';
require __DIR__.'/../Class/Billing.php';

use PHPUnit\Framework\Testcase;

class BillingTest extends TestCase
{
    public function testConstructException()
    {
        $item = new Item('Choclolate', 4);
        $this->assertEquals(true, $this->hasErrorBilling($item, -1));
        $this->assertEquals(true, $this->hasErrorBilling($item, null));
        $this->assertEquals(true, $this->hasErrorBilling($item, 0));
        $this->assertEquals(true, $this->hasErrorBilling($item, ''));
        $this->assertEquals(true, $this->hasErrorBilling($item, ' '));
    }

    protected function hasErrorBilling($item, $quantity)
    {
        $billing = new Billing();
        try {
            $billing->addItem($item, $quantity);
        } catch (InvalidArgumentException $e) {
            return true;
        }

        return false;
    }
}
