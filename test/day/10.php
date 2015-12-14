<? namespace Matura\Tests;

require('vendor/autoload.php');
require('day/10.php');

use AoC\Day;

describe('AoC Day 10', function($ctx) {
    before(function($ctx) {
        $ctx->Day = new Day();
    });

    describe('Algorithm validation', function($ctx) {
        $ctx->tests = array(
            "1" => '11',
            "11" => '21',
            "21" => '1211',
            "1211" => '111221',
            "111221" => '312211'
        );
        
        foreach (array_keys($ctx->tests) as $case) {
            $expected = $ctx->tests[$case];
            it('should correctly solve 1 iteration of "' . $case . '"',
               function($ctx) use ($case, $expected) {
                   expect($ctx->Day->look_say($case))->to->equal($expected);
               });
        };
        
        it('should correctly solve 5 iterations of "1"', function($ctx) {
            $case = '1';
            $expected = '312211';
            expect($ctx->Day->iterate($case, 5))->to->equal($expected);
        });
    });

    describe('Solution validation', function($ctx) {
        it('should return the length, not the value', function($ctx) {
            $case = '1';
            $expected = '6';
            expect($ctx->Day->solve_one($case, 5))->to->equal($expected);
        });
    });
});
?>