<?php

use lpeltier\Struct;

class Foo
{
    use Struct;

    public $public;
    protected $protected;
    private $private;
}

class StructTest extends PHPUnit_Framework_TestCase
{
    public function testPublicIsReadWritable()
    {
        $foo = new Foo();
        $this->assertFalse(isset($foo->public));
        $foo->public = 'bar';
        $this->assertTrue(isset($foo->public));
        $this->assertSame('bar', $foo->public);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testProtectedIsNotWritable()
    {
        $foo = new Foo();
        $this->assertFalse(isset($foo->protected));
        $foo->protected = 'bar';
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testPrivateIsNotWritable()
    {
        $foo = new Foo();
        $this->assertFalse(isset($foo->private));
        $foo->private = 'bar';
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testUnknownIsNotWritable()
    {
        $foo = new Foo();
        $this->assertFalse(isset($foo->bar));
        $foo->bar = 'foo';
    }

    public function testConstructorSetsPublicVars()
    {
        $foo = new Foo(['public' => 'foo']);
        $this->assertSame('foo', $foo->public);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructorDoesNotSetPrivateVars()
    {
        $foo = new Foo(['protected' => 'foo']);
    }
}
