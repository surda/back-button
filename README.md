# Back Button

[![Build Status](https://travis-ci.org/surda/back-button.svg?branch=master)](https://travis-ci.org/surda/back-button)
[![Licence](https://img.shields.io/packagist/l/surda/back-button.svg?style=flat-square)](https://packagist.org/packages/surda/back-button)
[![Latest stable](https://img.shields.io/packagist/v/surda/back-button.svg?style=flat-square)](https://packagist.org/packages/surda/back-button)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)

## Installation

The recommended way to is via Composer:

```
composer require surda/back-button
```

After that you have to register extension in config.neon:

```yaml
extensions:
    backButton: Surda\BackButton\BackButtonExtension
```

## Configuration

Default
```yaml
backButton:
    defaultPresenterLink: 'default'
    templates:
        default: bootstrap4.default.latte
        secondary: bootstrap4.secondary.latte
```

List of all configuration options:

```yaml
backButton:
    defaultPresenterLink: 'default'
    useAjax: false
    template: path/to/your/latte/file.latte
    # or
    templates:
        default: path/to/your/latte/file.latte
        foo: path/to/your/latte/foo.latte
        ...
```

## Usage

### Presenter

```php
use Nette\Application\UI\Presenter;
use Surda\BackButton\InjectBackButton;

abstract class ProductPresenter extends Presenter
{
    use InjectBackButton;
}
```

### Template

Source page (e.g. Product:default) add link to default.latte

```html
<a n:href="detail $id, destination => $currentLink">Detail</a>
```

Destination page (Product:detail) add component to detail.latte

```html
{control backButton}
```

### Destination

Presenter

```php
$this->template->destination = $this->link('detail', $id);
```

Latte

```html
{control backButton destination:$destination}
```

### Select control template file

Default template

```html
{control backButton} or {control backButton default}  
```

Set control template by type of template (see config.neon)

```html
{control backButton templateType}
```

### Reset

Reset persistent parameter <code>$destination</code> in URL <code>...?destination=%2Fproduct</code>

```html
<a n:href="default, destination => NULL">Products</a>
```
or all (defined) persistent parameters
```html
<a n:href="default, (expand) $resetPersistentParameters">Products</a>
```