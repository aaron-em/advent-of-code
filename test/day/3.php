<? namespace Matura\Tests;

require('vendor/autoload.php');
require('day/3.php');

use AoC\Day;

describe('AoC Day 3', function($ctx) {
    $ctx->tests = array(
        '^v' => array(2, 3),
        '^>v<' => array(4, 3),
        '^v^v^v^v^v' => array(2, 11)
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
