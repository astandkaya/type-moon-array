# type-moon-array

This library provides wrapper classes for arrays that allow you to specify element types and conditions.

## Installation
```
composer require astandkaya/type-moon-array
```

## Usage

### Decleare
  First argument is required. Specify "character string indicated in Type alias", "Closure", or "class with \TypeMoonArray\Types\Type as parent".
  Second argument is optional. Specifies the initial element of the array.
  Third argument is optional. Specify false to prohibit array operations other than the constructor.

  Type alias : `bool`,`int`,`float`,`string`,`array`,`object`,`null`,`mixed`

``` php
use TypeMoonArray\TmArray;

// OK (array of int only)
$tm_array = new TmArray( 'int', range(1,10), true );


// OK (array of int and [0 <= $variable <= 100] )
class MyClass implements \TypeMoonArray\Types\Type
{
    public static function checkType( mixed $variable ) : bool
    {
        return $variable == (int)$variable && 0 <= $variable && $variable <= 10;
    }

    public static function normalizeType( mixed $variable ) : mixed
    {
        return (int)$variable;
    }
}

$tm_array = new TmArray( MyClass::class, range(1,10) );


// OK (array of int and [0 <= $variable <= 100] )
$tm_array = new TmArray(
	fn ($v) => $v == (int)$v && 0 <= $v && $v <= 10,
	range(1,10),
);

```

### Get & Set

You can get all elements or element corresponding to the key with the `get()`.
and, you can also get a key list with the `getKeys()`.

``` php
use TypeMoonArray\TmArray;

$tm_array = new TmArray( 'int', range(1,3) );

$tm_array->get(); // [1,2,3]


$tm_array = new TmArray( 'int', array_combine( range('a','c'), range(1,3) ) );

$tm_array->get('c'); // 3
$tm_array->getKeys(); // ['a','b','c']

```

You can add elements to the array using `push()` or `unshift()`.
and, you can optionally specify a key as the second argument.

``` php
use TypeMoonArray\TmArray;

$tm_array = new TmArray( 'int', range(1,3) );
$tm_array->unshift(0);
$tm_array->push(4);

$tm_array->get(); // [0,1,2,3,4]


$tm_array = new TmArray( 'int', array_combine( range('a','c'), range(1,3) ) );
$tm_array->push( 4, 'd');

$tm_array->get('d'); // 4

```

### Edit

Array operations can be performed by specifying a closure or function name in `closure()` or `closureRef()`.

``` php
use TypeMoonArray\TmArray;

$tm_array = new TmArray( 'int', range(1,5) );
$tm_array->closure( fn( $arr ) => array_reverse( $arr ) );

$tm_array->get(); // [5,4,3,2,1]


$tm_array = new TmArray( 'int', range(1,5) );
$tm_array->closure( 'array_reverse' );

$tm_array->get(); // [5,4,3,2,1]


$tm_array = new TmArray( 'int', range(1,5) );
$tm_array->closureRef( 'array_multisort', SORT_DESC );

$tm_array->get(); // [5,4,3,2,1]

```


## TmArray Methods

- `function __construct( protected \Closure|string $type, protected array $array = [], protected bool $is_writable = true )`

- `get( ?string $key = null ) : mixed`

- `getKeys() : array`

- `getStdTypeAlias() : array`

- `convertType( string $type ) : void`

- `closure( \Closure|string $func, mixed ...$args ) : array`

- `closureRef( \Closure|string $func, mixed ...$args ) : array`

- `push( mixed $value, ?string $key = null ) : void`

- `unshift( mixed $value, ?string $key = null ) : void`
