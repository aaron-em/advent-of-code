<? namespace Matura\Tests;

require('vendor/autoload.php');
require('day/12.php');

use AoC\Day;

describe('AoC Day 12', function($ctx) {
    $ctx->tests = array(
        '[1,2,3]' => 6,
        '{"a": 2, "b": 4}' => 6,
        '[[[3]]]' => 3,
        '{"a":{"b":4},"c":-1}' => 3,
        '{"a":[-1,1]}' => 0,
        '[-1,{"a":1}]' => 0,
        '[]' => 0,
        '{}' => 0
    );

    $ctx->tests_redless = array(
        '[1,2,3]' => 6,
        '[1,{"c":"red","b":2},3]' => 4,
        '{"d":"red","e":[1,2,3,4],"f":5}' => 0,
        '[1,"red",5]' => 6
    );

    before(function($ctx) {
        $ctx->Day = new Day();
    });

    foreach (array_keys($ctx->tests) as $case) {
        $expected = $ctx->tests[$case];
        it('should correctly sum "' . preg_replace('/\n/', '\\n', $case) . '"',
           function($ctx) use ($case, $expected) {
               expect($ctx->Day->sum($case))->to->equal($expected);
           });
    };
    
    foreach (array_keys($ctx->tests_redless) as $case) {
        $expected = $ctx->tests_redless[$case];
        it('should redlessly sum "' . preg_replace('/\n/', '\\n', $case) . '"',
           function($ctx) use ($case, $expected) {
               expect($ctx->Day->sum($case, true))->to->equal($expected);
           });
    };
});
?>