<? namespace Matura\Tests;

require('vendor/autoload.php');
require('day/1.php');

use AoC\Day;

describe('AoC Day 1', function($ctx) {
    $ctx->tests = array(
        '(())' => array(0, null),
        '()()' => array(0, null),
        '(((' => array(3, null),
        '(()(()(' => array(3, null),
        '))(((((' => array(3, 1),
        '())' => array(-1, 3),
        '))(' => array(-1, 1),
        ')))' => array(-3, 1),
        ')())())' => array(-3, 1)
    );
    
    before(function($ctx) {
        $ctx->Day = new Day();
    });

    foreach (array_keys($ctx->tests) as $case) {
        $expected = $ctx->tests[$case];
        it('should correctly solve "' . $case . '"',
           function($ctx) use ($case, $expected) {
               expect($ctx->Day->solve($case))->to->equal($expected);
           });
    };
});

?>