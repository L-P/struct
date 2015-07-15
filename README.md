struct
======
struct-like trait for PHP.

Usage
-----
Create a struct by using the `struct` trait in a class and declaring **public**
properties. You can then read and write those properties using the arrow (`->`)
operator. Any attempt to access an undefined, protected, or private property
will result in an exception.  
You can also use the constructor to set all properties at once.

Example:
```php
<?php

use lpeltier\Struct;

class Foo
{
    use Struct;

    public $foo = 'default';
    public $bar;
}

$foo = new Foo(['bar' => 0x2A]);

var_dump($foo->foo); // 'default'
var_dump($foo->bar); // 42
var_dump($foo->baz); // throws an exception
```

Why
---
PHP automatically creates unknown properties when you set them, without even
throwing a notice. This can lead to one those silly bugs that takes ages to
find because you wrote 'nuw' instead of 'num'.
