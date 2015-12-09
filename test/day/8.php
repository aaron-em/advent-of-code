<? namespace Matura\Tests;

require('vendor/autoload.php');
require('day/8.php');

use AoC\Day;

describe('AoC Day 8', function($ctx) {
    $ctx->tests = array(
        '""' => array(2, 4),   
        '"abc"' => array(2, 4), 
        '"aaa\\"aaa"' => array(3, 6), 
        '"\\x27"' => array(5, 5), 
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