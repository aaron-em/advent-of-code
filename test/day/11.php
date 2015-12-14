<? namespace Matura\Tests;

require('vendor/autoload.php');
require('day/11.php');

use AoC\Day;

describe('AoC Day 11', function($ctx) {
    before(function($ctx) {
        $ctx->Day = new Day();
    });

    describe('Rule validation', function($ctx) {
        it('should correctly check rule 1 (sequences)', function($ctx) {
            expect($ctx->Day->check_rules('ddcbaa'))
                ->to->equal(1);
            expect($ctx->Day->check_rules('aabcdd'))
                ->to->equal(0);
        });

        it('should correctly check rule 2 (stopchars)', function($ctx) {
            expect($ctx->Day->check_rules('abcddeei'))
                ->to->equal(2);
            expect($ctx->Day->check_rules('abcddeeo'))
                ->to->equal(2);
            expect($ctx->Day->check_rules('abcddeel'))
                ->to->equal(2);
            expect($ctx->Day->check_rules('abcddee'))
                ->to->equal(0);
        });

        it('should correctly check rule 3 (pairs)', function($ctx) {
            expect($ctx->Day->check_rules('aabcd'))
                ->to->equal(3);
            expect($ctx->Day->check_rules('aaabcd')) // overlaps don't count
                ->to->equal(3);
            expect($ctx->Day->check_rules('aabcdd'))
                ->to->equal(0);
        });
        
        it('should correctly accept "ghjaabcc"', function($ctx) {
            expect($ctx->Day->check_rules('ghjaabcc'))
                ->to->equal(0);
        });
    });

    describe('Next-password finding', function($ctx) {
        it('should correctly find next for "abcdefgh"', function($ctx) {
            expect($ctx->Day->find_next('abcdefgh'))
                ->to->equal('abcdffaa');
        });
    });
});
?>