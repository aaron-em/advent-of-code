<? namespace Matura\Tests;

require('vendor/autoload.php');
require('day/2.php');

use AoC\Day;

describe('AoC Day 2', function($ctx) {
    $ctx->tests = array(
        '2x3x4' => array(58, 34),
        '1x1x10' => array(43, 14),
        '3x3x3' => array(63, 39)
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
