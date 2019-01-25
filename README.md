Laravel Nova Filter Card Package
[![Latest Version on Github](https://img.shields.io/packagist/v/dkulyk/nova-card-filter.svg?style=flat)](https://packagist.org/packages/dkulyk/nova-card-filter)
[![Total Downloads](https://img.shields.io/packagist/dt/dkulyk/nova-card-filter.svg?style=flat)](https://packagist.org/packages/dkulyk/nova-card-filter)
[![Become a Patron!](https://img.shields.io/badge/become-a_patron!-red.svg?logo=patreon&style=flat)](https://www.patreon.com/bePatron?u=16285116)


1. [Installation](#user-content-installation)
2. [Usage](#user-content-usage)

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require dkulyk/nova-card-filter
```

## Usage

You need to add card to resource with specified filter.

```php

use DKulyk\Nova\FilterCard;
use App\Nova\Filters\StateFilter;

public function filters()
{
    return [
        new StateFilter(),
    ];
}

public function filters()
{
    return [
        // Other cards...,
        new FilterCard(new StateFilter()),
    ];
}
```