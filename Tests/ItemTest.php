<?php
require __DIR__.'/../Class/Item.php';
require __DIR__.'/../Interface/TaxInterface.php';
require __DIR__.'/../Class/BaseTax.php';
require __DIR__.'/../Class/ImportTax.php';

use PHPUnit\Framework\Testcase;

class ItemTest extends TestCase
{
    private $item;

    public function testConstruct()
    {
        $this->item = new Item('Choclolate', 4);
        
        //Test valid input
        $this->assertEquals('Choclolate', $this->item->getName());
        $this->assertEquals(4, $this->item->getBaseAmount());
    }

    protected function isConstructExceptionThrown($name, $base_amount)
    {
        try {
            $this->item = new Item($name, $base_amount);
        } catch (InvalidArgumentException $e) {
            return true;
        }

        return false;
    }
    public function testConstructThrowsException()
    {
        //Test exception
        
        $this->assertEquals(true, $this->isConstructExceptionThrown('', 4));
        $this->assertEquals(true, $this->isConstructExceptionThrown('Chocolate', 0));
        $this->assertEquals(true, $this->isConstructExceptionThrown(null, 4));
        $this->assertEquals(true, $this->isConstructExceptionThrown('Chocolate', -4));
        $this->assertEquals(true, $this->isConstructExceptionThrown('Chocolate', null));
        $this->assertEquals(true, $this->isConstructExceptionThrown('Chocolate', ''));
    }

    public function testApplyTaxForBase()
    {
        //basetax- 10%, importtax-5%
        
        $this->item = new Item('music cd', 14.99);
        $tax_obj = new BaseTax();
        $this->item->applyTax($tax_obj);
        $this->assertEquals(16.49, $this->item->getTotalCost());
        $this->assertEquals(1.5, $this->item->getTotalTax());

        $this->item = new Item('imported bottle of perfume', 47.50);
        $tax_obj = new BaseTax();
        $this->item->applyTax($tax_obj);
        $tax_obj = new ImportTax();
        $this->item->applyTax($tax_obj);
        
        $this->assertEquals(54.65, $this->item->getTotalCost());
        $this->assertEquals(7.15, $this->item->getTotalTax());
    }

    public function testApplyTaxForImport()
    {
        //basetax- 10%, importtax-5%
        
        $this->item = new Item('imported box of chocolates', 10.00);
        $tax_obj = new ImportTax();
        $this->item->applyTax($tax_obj);
        $this->assertEquals(10.50, $this->item->getTotalCost());
        $this->assertEquals(0.5, $this->item->getTotalTax());
    }

    protected function tearDown()
    {
        $this->item = null;
    }
}
