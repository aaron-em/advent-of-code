<? namespace Matura\Tests;

require('vendor/autoload.php');
require('day/6.php');

use AoC\Day;

describe('AoC Day 6', function($ctx) {
    before(function($ctx) {
        $ctx->day = new Day();
    });
    
    describe('#decompose', function($ctx) {
        it('should correctly decompose a "turn on" instruction', function($ctx) {
            expect($ctx->day->decompose('turn on 1,1 through 2,2'))
                ->to->eql(array(
                    0 => array(1, 1),
                    1 => array(
                        array(1, 1),
                        array(1, 1)
                    )
                ));
        });

        it('should correctly decompose a "turn off" instruction', function($ctx) {
            expect($ctx->day->decompose('turn off 1,1 through 2,2'))
                ->to->eql(array(
                    0 => array(1, 1),
                    1 => array(
                        array(0, 0),
                        array(0, 0)
                    )
                )); 
       });

        it('should correctly decompose a "toggle" instruction', function($ctx) {
            expect($ctx->day->decompose('toggle 1,1 through 2,2'))
                ->to->eql(array(
                    0 => array(1, 1),
                    1 => array(
                        array(-1, -1),
                        array(-1, -1)
                    )
                )); 
       });
    });

    describe('#apply_switches', function($ctx) {
        it('should correctly apply a "turn on" instruction', function($ctx) {
            $grid = array(array(0));
            $corner = array(1, 1);
            $transform = array(array(1));

            expect($ctx->day->apply_switches($grid, $corner, $transform))
                ->to->eql(array(array(1)));
        });

        it('should correctly apply a "turn off" instruction', function($ctx) {
            $grid = array(array(1));
            $corner = array(1, 1);
            $transform = array(array(0));

            expect($ctx->day->apply_switches($grid, $corner, $transform))
                ->to->eql(array(array(0)));
        });

        it('should correctly apply a "toggle" instruction', function($ctx) {
            $grid = array(array(0));
            $corner = array(1, 1);
            $transform = array(array(-1));

            expect($ctx->day->apply_switches($grid, $corner, $transform))
                ->to->eql(array(array(1)));
        });
        
        it('should correctly iterate dimensions', function($ctx) {
            $grid = array(
                array(0, 0),
                array(0, 0)
            );
            $corner = array(1, 1);
            $transform = array( 
                array(-1, 0),
                array(0, -1)
            );
            $expected = array(
                array(1, 0),
                array(0, 1),
            );
            
            expect($ctx->day->apply_switches($grid, $corner, $transform))
                ->to->eql($expected);
        });
    });

    describe('#apply_brightness', function($ctx) {
        it('should correctly apply a "turn on" instruction', function($ctx) {
            $grid = array(array(1));
            $corner = array(1, 1);
            $transform = array(array(1));

            expect($ctx->day->apply_brightness($grid, $corner, $transform))
                ->to->eql(array(array(2)));
        });

        it('should correctly apply a "turn off" instruction', function($ctx) {
            $grid = array(array(2));
            $corner = array(1, 1);
            $transform = array(array(0));

            expect($ctx->day->apply_brightness($grid, $corner, $transform))
                ->to->eql(array(array(1)));
        });

        it('should correctly apply a "toggle" instruction', function($ctx) {
            $grid = array(array(0));
            $corner = array(1, 1);
            $transform = array(array(-1));

            expect($ctx->day->apply_brightness($grid, $corner, $transform))
                ->to->eql(array(array(2)));
        });
        
        it('should correctly iterate dimensions', function($ctx) {
            $grid = array(
                array(0, 0),
                array(0, 0)
            );
            $corner = array(1, 1);
            $transform = array( 
                array(-1, 0),
                array(0, -1)
            );
            $expected = array(
                array(2, 0),
                array(0, 2),
            );
            
            expect($ctx->day->apply_brightness($grid, $corner, $transform))
                ->to->eql($expected);
        });
    });

    describe('#total', function($ctx) {
        it('should correctly sum a grid', function($ctx) {
            $grid = array(
                array(1, 2, 3),
                array(4, 5, 6)
            );
            expect($ctx->day->total($grid))->to->equal(21);
        });
    });

    describe('#solve', function($ctx) {
        it('should produce correct results', function($ctx) {
            expect($ctx->day->solve("toggle 1,1 through 1,1"))
                ->to->eql(array(1, 2));
        });
    });
});
?>