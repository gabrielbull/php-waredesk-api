<p align="center"><img width="430"src="https://cdn.rawgit.com/gabrielbull/php-waredesk-api/master/logo.svg"></p>

<p align="center">
  <a href="https://travis-ci.org/gabrielbull/php-waredesk-api"><img src="https://img.shields.io/travis/gabrielbull/php-waredesk-api.svg?style=flat-square" alt="Build Status"></a>
  <a href="https://styleci.io/repos/66044951"><img src="https://styleci.io/repos/66044951/shield" alt="StyleCI"></a>
  <a href="https://scrutinizer-ci.com/g/gabrielbull/php-waredesk-api/?branch=master"><img src="https://img.shields.io/scrutinizer/g/gabrielbull/php-waredesk-api.svg?style=flat-square" alt="Scrutinizer Code Quality"></a>
  <a href="https://scrutinizer-ci.com/g/gabrielbull/php-waredesk-api/?branch=master"><img src="https://img.shields.io/scrutinizer/coverage/g/gabrielbull/php-waredesk-api.svg?style=flat-square" alt="Code Coverage"></a>
  <a href="https://codeclimate.com/github/gabrielbull/php-waredesk-api"><img src="https://img.shields.io/codeclimate/github/gabrielbull/php-waredesk-api.svg?style=flat-square" alt="Code Climate"></a>
  <a href="https://packagist.org/packages/waredesk/waredesk-api"><img src="https://img.shields.io/packagist/v/waredesk/waredesk-api.svg?style=flat-square" alt="Latest Stable Version"></a>
</p>

This library is aimed at wrapping the Waredesk API into a simple to use PHP Library. Feel free to contribute.

## Table Of Content

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Logging](#logging)
4. [License](#license)

<a name="requirements"></a>
## Requirements

This library uses PHP 7.1+.

To use the Waredesk library, you have to [obtain credentials from Waredesk](https://waredesk.com/). For every request,
you will have to provide the API key.

<a name="installation"></a>
## Installation

It is recommended that you install the Waredesk library [through composer](http://getcomposer.org/). To do so,
run the Composer command to install the latest stable version of Waredesk:

```shell
composer require waredesk/waredesk-api
```

<a name="logging"></a>
## Logging

The Waredesk constructor takes a PSR-3 compatible logger.

Requests & responses are logged at DEBUG level. At INFO level only the event is reported, not the response content. 
More severe problems (e.g. no connection) are logged with higher severity.

<a name="license"></a>
## License

This library is licensed under The MIT License (MIT).
