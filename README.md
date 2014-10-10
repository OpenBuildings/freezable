Freezable
=========

[![Build Status](https://travis-ci.org/clippings/freezable.png?branch=master)](https://travis-ci.org/clippings/freezable)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/clippings/freezable/badges/quality-score.png)](https://scrutinizer-ci.com/g/clippings/freezable/)
[![Code Coverage](https://scrutinizer-ci.com/g/clippings/freezable/badges/coverage.png)](https://scrutinizer-ci.com/g/clippings/freezable/)
[![Latest Stable Version](https://poser.pugx.org/clippings/freezable/v/stable.png)](https://packagist.org/packages/clippings/freezable)

Freeze values in objects

Requires PHP 5.4 or above.

Usage
-----

``` php
<?php

use Clippings\Freezable\FreezableTrait;

class Item {

    use FreezableTrait;

    private $value = NULL;

    public function performFreeze()
    {
        $this->value = $this->computeValue();
    }

    public function performUnfreeze()
    {
        $this->value = NULL;
    }

    private function computeValue()
    {
        // computation from external sources, database, other objects etc.
        return pi() * pi();
    }

    public function getValue()
    {
        return $this->isFrozen() ? $this->value : $this->computeValue();
    }
}
```

License
-------

Copyright (c) 2014, Clippings Ltd. Developed by Ivan Kerin &amp; Haralan Dobrev

Under BSD-3-Clause license, read LICENSE file.
