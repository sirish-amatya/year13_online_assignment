# Year13 Online Assignment

This program solves the problem provided by Year13 


## Assumptions
1. The price in the input is the unit price of the product
2. The output price also displays the unit price of the product including tax
3. The category of items (exempted item or imported item) is hardcoded

## Folder Structure

```
.
├── Class
│   ├── BaseTax.php
│   ├── Billing.php
│   ├── Category.php
│   ├── ImportTax.php
│   └── Item.php
├── Input
│   ├── input1.txt
│   ├── input2.txt
│   └── input3.txt
├── Interface
│   └── TaxInterface.php
├── main.php
└── Tests
    ├── BillingTest.php
    ├── CategoryTest.php
    └── ItemTest.php
```

### Executing the program

```
php main.php input1.txt
php main.php input2.txt
php main.php input3.txt
```

### Sample program output

```
php main.php input1.txt
```

```
Quantity, Product, Price
1, book, 12.49
1, music cd, 16.49
1, chocolate bar, 0.85

Sales Tax: 1.50
Total: 29.83
```
### Prerequisites

php-cli
