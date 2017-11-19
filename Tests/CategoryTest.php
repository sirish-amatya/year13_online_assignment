<?php
require __DIR__.'/../Class/Category.php';
require __DIR__.'/../Class/Item.php';

use PHPUnit\Framework\Testcase;

class CategoryTest extends TestCase
{
    public function testIsTaxApplicable()
    {
        $item = new Item('chocolate bar', 10);
        $this->assertEquals(false, Category::IsTaxApplicable($item));
        $item = new Item('book', 10);
        $this->assertEquals(false, Category::IsTaxApplicable($item));
        $item = new Item('packet of headache pills', 10);
        $this->assertEquals(false, Category::IsTaxApplicable($item));
        $item = new Item('imported bottle of perfume', 10);
        $this->assertEquals(true, Category::IsTaxApplicable($item));
    }

    public function testIsImported()
    {
        $item = new Item('chocolate bar', 10);
        $this->assertEquals(false, Category::IsImported($item));
        $item = new Item('book', 10);
        $this->assertEquals(false, Category::IsImported($item));
        $item = new Item('packet of headache pills', 10);
        $this->assertEquals(false, Category::IsImported($item));
        $item = new Item('imported bottle of perfume', 10);
        $this->assertEquals(true, Category::IsImported($item));
    }
}
