<? namespace Matura\Tests;

require('vendor/autoload.php');
require('day/14.php');

use AoC\Day;

describe('AoC Day 14', function($ctx) {
    before(function($ctx) {
        $ctx->Day = new Day();
    });

    it('should correctly parse a race description', function($ctx) {
        $case = join("\n", array(
            "Comet can fly 14 km/s for 10 seconds, but then must rest for 127 seconds.",
            "Dancer can fly 16 km/s for 11 seconds, but then must rest for 162 seconds."
        ));
        $expected = array(
            'Comet' => array(14, 10, 127),
            'Dancer' => array(16, 11, 162)
        );
        
        expect($ctx->Day->prep_race($case))
            ->to->equal($expected);
    });

    it('should correctly make steps for a race', function($ctx) {
        $case = join("\n", array(
            "Comet can fly 1 km/s for 2 seconds, but then must rest for 3 seconds.",
            "Dancer can fly 3 km/s for 1 seconds, but then must rest for 4 seconds."
        ));
        $expected = array(
            'Comet' => array(1, 1, 0, 0, 0),
            'Dancer' => array(3, 0, 0, 0, 0)
        );

        $race = $ctx->Day->prep_race($case);
        expect($ctx->Day->make_steps($race))
            ->to->equal($expected);
    });

    it('should correctly run the example race', function($ctx) {
        $case = join("\n", array(
            "Comet can fly 14 km/s for 10 seconds, but then must rest for 127 seconds.",
            "Dancer can fly 16 km/s for 11 seconds, but then must rest for 162 seconds."
        ));
        $expected = 1120;

        $race = $ctx->Day->prep_race($case);
        expect($ctx->Day->run_race($race, 1000))
            ->to->equal($expected);
    });

    it('should correctly run the example leaderboard', function($ctx) {
        $case = join("\n", array(
            "Comet can fly 14 km/s for 10 seconds, but then must rest for 127 seconds.",
            "Dancer can fly 16 km/s for 11 seconds, but then must rest for 162 seconds."
        ));
        $expected = 689;

        $race = $ctx->Day->prep_race($case);
        expect($ctx->Day->run_leader($race, 1000))
            ->to->equal($expected);
    });
});
?>