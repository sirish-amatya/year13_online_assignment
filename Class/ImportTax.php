<?php

class ImportTax implements Tax
{
    /**
     * Returns the import tax rate
     * @return float
     */
    public function getTaxRate()
    {
        return 0.05;
    }
}
