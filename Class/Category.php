<?php

class Category
{
    
    /**
     * Returns true if base tax is applicable else false.
     *
     * Currently, hardcoded values are used to determine. Ideally, there should
     * be another property of item which determines it's type and should be provided
     * in the input.
     * Exempted Items: Food, Book, Medical products
     * @param  Item    $item
     * @return boolean
     */
    public static function isTaxApplicable(Item $item)
    {
        //Book, Food and Medical products are exempted.
        $exempted_items = array(
            'chocolate bar',
            'imported box of chocolates',
            'box of imported chocolates',
            'book',
            'packet of headache pills'
        );
        
        if (in_array(strtolower($item->getName()), $exempted_items)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Returns true if import tax is applicable else false.
     *
     * Currently, hardcoded values are used to determine. Ideally, there should
     * be another property of item which determines it's import status and should
     * be provided in the input
     * 'import' keyword was found in all imported goods and can also be used as an
     * identifier
     * @param  Item    $item
     * @return boolean
     */
    public static function isImported(Item $item)
    {
        $imported_items = array(
            'imported box of chocolates',
            'imported bottle of perfume',
            'box of imported chocolates'
        );
        
        if (in_array(strtolower($item->getName()), $imported_items)) {
            return true;
        } else {
            return false;
        }
    }
}
