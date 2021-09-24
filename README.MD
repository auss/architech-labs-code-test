# Acme Widget Co

## Directory structure

- spec - contains [phpspec](http://www.phpspec.net/en/stable/) files that were used to design and test the solution. **All requirements for shipping costs, special offers and totals are contained and tested there**
- src - contains PHP classes:
    - src/Catalogue - product catalogue classes
    - src/Order - shopping cart classes
- vendor - 3rd party vendor files for phpspec

## Run & test

To test this solution, please execute
`composer install` in the first place to generate autoload.php file. Then please execute
command `vendor/bin/phpspec run`

# Use in code

Example in file run.php
