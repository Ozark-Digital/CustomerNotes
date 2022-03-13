# Magento2 Customer Note and Complaint Logger

## Description

Ability to log notes/complaints onto the customers account within the magento 2 backend.

Tested on Magento 2 Version 2.4

## Install Via Composer

```bash
composer config repositories.customernotes git 
composer require ozark/customernotes
php bin/magento module:enable Ozark/customernotes
php bin/magento setup:di:compile 
php bin/magento setup:upgrade
php bin/magento cache:flush
```

## Install Via File System

1. Download repository and place into 'app\code\Ozark\CustomerNotes'
2. Run the following commands
```bash
php bin/magento module:enable Ozark/customernotes
php bin/magento setup:di:compile 
php bin/magento setup:upgrade
php bin/magento cache:flush
```


