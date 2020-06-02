# Array Analyzer
Library for associative arrays analyze
## Installation
`composer require pavelzheltok/arrayanalyzer`
## Usage
###
Function `findKeysPaths(array $array, string $key)`.

Function returns array with all found keys and their paths. Path is string of joined by dots keys. 

Parameters:

`$array` - array for searching

`$key` - key which should be found

````
include_once 'vendor/autoload.php';
use PZ\ArrayAnalyzer;`
$myArray = [
    'mykey1' => 'value',
    'mykey2' => [
        'mykey' => 'value',
        'mykey1' => 'value3',
    ],
];

$result = ArrayAnalyzer::findKeysPaths($myArray, 'mykey1');
var_dump($result);
````
Output
````
array(2) {
  [0]=>
  string(6) "mykey1"
  [1]=>
  string(13) "mykey2.mykey1"
}
````
###
Function `findMaxDepth(array $array)`.

Functions calculates max array depth.
````
include_once 'vendor/autoload.php';
use PZ\ArrayAnalyzer;`
$myArray = [
    'mykey1' => 'value',
    'mykey2' => [
        'mykey' => 'value',
        'mykey1' => 'value3',
    ],
];

$result = ArrayAnalyzer::findMaxDepth($myArray);
var_dump($result);
````
Output
````
int(2)
````
