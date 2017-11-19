<?php

class BaseTax implements Tax
{
    /**
     * Returns the base tax rate
     * @return float
     */
    public function getTaxRate()
    {
        return 0.10;
    }
}
