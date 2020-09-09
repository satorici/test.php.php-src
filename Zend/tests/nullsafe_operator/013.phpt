--TEST--
Test nullsafe property in special functions
--FILE--
<?php

function dump_error(callable $callable) {
    try {
        var_dump($callable());
    } catch (Throwable $e) {
        var_dump($e->getMessage());
    }
}

function foo() {}

$foo = null;
dump_error(fn() => strlen($foo?->foo()));
dump_error(fn() => is_null($foo?->foo()));
dump_error(fn() => is_bool($foo?->foo()));
dump_error(fn() => is_int($foo?->foo()));
dump_error(fn() => is_scalar($foo?->foo()));
dump_error(fn() => boolval($foo?->foo()));
dump_error(fn() => defined($foo?->foo()));
dump_error(fn() => chr($foo?->foo()));
dump_error(fn() => ord($foo?->foo()));
dump_error(fn() => call_user_func_array($foo?->foo(), []));
dump_error(fn() => call_user_func_array('foo', $foo?->foo()));
dump_error(fn() => get_class($foo?->foo()));
dump_error(fn() => get_called_class($foo?->foo()));
dump_error(fn() => gettype($foo?->foo()));
dump_error(fn() => func_num_args($foo?->foo()));
dump_error(fn() => func_get_args($foo?->foo()));
dump_error(fn() => array_slice($foo?->foo(), 0));
dump_error(fn() => array_slice(['foo'], $foo?->foo()));
dump_error(fn() => array_slice(['foo'], 0, $foo?->foo()));
dump_error(fn() => array_key_exists($foo?->foo(), []));
dump_error(fn() => array_key_exists('foo', $foo?->foo()));

?>
--EXPECTF--
int(0)
bool(true)
bool(false)
bool(false)
bool(false)
bool(false)
bool(false)
string(1) "%s"
int(0)
string(98) "call_user_func_array(): Argument #1 ($function) must be a valid callback, no array or string given"
string(77) "call_user_func_array(): Argument #2 ($args) must be of type array, null given"
string(69) "get_class(): Argument #1 ($object) must be of type object, null given"
string(56) "get_called_class() expects exactly 0 parameters, 1 given"
string(4) "NULL"
string(53) "func_num_args() expects exactly 0 parameters, 1 given"
string(53) "func_get_args() expects exactly 0 parameters, 1 given"
string(69) "array_slice(): Argument #1 ($array) must be of type array, null given"
array(1) {
  [0]=>
  string(3) "foo"
}
array(1) {
  [0]=>
  string(3) "foo"
}
bool(false)
string(74) "array_key_exists(): Argument #2 ($array) must be of type array, null given"