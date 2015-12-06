<? namespace Matura\Tests;

require('vendor/autoload.php');
require('day/5.php');

use AoC\Day;

describe('AoC Day 5', function($ctx) {
    $ctx->tests = array(
        'ugknbfddgicrmopn' => array(1, 0),
        'aaa' => array(1, 0),
        'jchzalrnumimnmhp' => array(0, 0),
        'haegwjzuvuyypxyu' => array(0, 0),
        'dvszwmarrgswjxmb' => array(0, 0),
        "aaa\neee\naxy\n" => array(2, 0),
        "qjhvhtzxzqqjkmpb" => array(0, 1),
        "xxyxx" => array(0, 1)
    );

    before(function($ctx) {
        $ctx->Day = new Day();
    });

    foreach (array_keys($ctx->tests) as $case) {
        $expected = $ctx->tests[$case];
        it('should correctly solve "' . preg_replace('/\n/', '\\n', $case) . '"',
           function($ctx) use ($case, $expected) {
               expect($ctx->Day->solve($case))->to->equal($expected);
           });
    };
});
?>