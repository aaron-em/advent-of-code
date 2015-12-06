<? namespace Matura\Tests;

require('vendor/autoload.php');
require('day/4.php');

use AoC\Day;

describe('AoC Day 4', function($ctx) {
    $ctx->tests = array(
        "bgvyzdsv" => array(254575, 1038736)
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