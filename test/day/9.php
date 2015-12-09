<? namespace Matura\Tests;

require('vendor/autoload.php');
require('day/9.php');

use AoC\Day;

describe('AoC Day 9', function($ctx) {
    $ctx->tests = array(
        "London to Dublin = 464\nLondon to Belfast = 518\nDublin to Belfast = 141\n"
        => array(605, null)
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