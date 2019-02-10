## Laravel Nova Filter Card Package
[![Latest Version on Github](https://img.shields.io/packagist/v/awesome-nova/filter-card.svg?style=flat)](https://packagist.org/packages/awesome-nova/filter-card)
[![Total Downloads](https://img.shields.io/packagist/dt/awesome-nova/filter-card.svg?style=flat)](https://packagist.org/packages/awesome-nova/filter-card)
[![Become a Patron!](https://img.shields.io/badge/become-a_patron!-red.svg?logo=patreon&style=flat)](https://www.patreon.com/bePatron?u=16285116)


1. [Installation](#user-content-installation)
2. [Usage](#user-content-usage)

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require awesome-nova/filter-card
```

## Usage

You need to add card to resource with specified filter.

```php

use AwesomeNova\Cards\FilterCard;
use App\Nova\Filters\StateFilter;

public function filters()
{
    return [
        new StateFilter(),
    ];
}

public function cards()
{
    return [
        // Other cards...,
        new FilterCard(new StateFilter()),
    ];
}
```
![](https://user-images.githubusercontent.com/370042/51752652-a8d74280-20c0-11e9-9123-090d2cd13c74.png)
