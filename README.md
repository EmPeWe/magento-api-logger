Magento SOAP API Logger
=======================

Facts
-----
- version: 0.0.1
- [extension on GitHub](https://github.com/EmPeWe/magento-api-logger)

Description
-----------
This Magento extensions allow the API calls to be logged. At the moment only SOAP API v1/v2 could be logged.

Requirements
------------
- PHP >= 5.2.0
- Mage_Core

Compatibility
-------------
- Tested on Magento 1.8.1

Installation Instructions
-------------------------
1. Install/Deploy the extension via modman or copy all the files into your document root.
2. Clear the cache, logout from the admin panel and then login again.
3. Configure and activate the extension under System - Configuration - EMPEWE - SOAP ApiLogger.

Uninstallation
--------------
1. Remove all extension files from your Magento installation
2. Delete all entry from core_config_data with path starting like 'apilogger_options/config/%'

Support
-------
If you have any issues with this extension, open an issue on [GitHub](https://github.com/EmPeWe/magento-api-logger/issues).

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Copyright
---------
(c) 2014 EmPeWe
