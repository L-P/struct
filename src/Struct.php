<?php declare(strict_types=1);

/* Originally written for yks under the MIT license.
 * See https://github.com/131/yks */

namespace lpeltier;

/** @return string[] public property names */
function get_public_properties(object $obj): array
{
    return array_column(
        (new \ReflectionObject($obj))->getProperties(\ReflectionProperty::IS_PUBLIC),
        'name'
    );
}

/** Ensure that a class can't have 'floating properties'. Any attemp to get or
 * set a property that was not defined in the class declaration will throw an
 * exception.
 *
 * This is to be used instead of 'anonymous' arrays, like you would use structs
 * in C.
 */
trait Struct
{
    /// @param mixed[] $props properties to set, name => value.
    public function __construct(array $props = [])
    {
        $publicProps = get_public_properties($this);

        foreach ($props as $k => $v) {
            if (in_array($k, $publicProps, true)) {
                $this->$k = $v;
            } else {
                $this->__set($k, $v);
            }
        }
    }

    public function __set(string $name, $value)
    {
        throw new \InvalidArgumentException("Attempted to set unkown property `$name`.");
    }

    public function __isset(string $name): bool
    {
        return false;
    }

    public function __get(string $name)
    {
        throw new \InvalidArgumentException("Attempted to get unkown property `$name`.");
    }

    public function __unset(string $name)
    {
        throw new \InvalidArgumentException("Attempted to unset unkown property `$name`.");
    }
}
