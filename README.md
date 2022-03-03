# Magento2 Customer Note Log

## Description



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


