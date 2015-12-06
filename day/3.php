<?
namespace AoC;

class Day {
    public function solve($input) {
        $pos = array(
            array(0, 0), // santa
            array(0, 0)  // robo-santa
        );
        $pos_n = 0;
        $visited = array(
            0 => array(
                0 => 1
            )
        );
        $result1 = 1;
        $result2 = 1;

        $moves = str_split($input);

        // find count for just plain santa
        for ($i = 0; $i < sizeof($moves); $i++) {
            $move = $moves[$i];
            $delta = array(0, 0);

            switch ($move) {
            case '^':
                $delta = array(0, -1);
                break;
            case '>':
                $delta = array(1, 0);
                break;
            case 'v':
                $delta = array(0, 1);
                break;
            case '<':
                $delta = array(-1, 0);
                break;
            };
            
            $pos[$pos_n][0] += $delta[0];
            $pos[$pos_n][1] += $delta[1];

            if (@$visited[$pos[$pos_n][0]][$pos[$pos_n][1]] != 1) {
                $visited[$pos[$pos_n][0]][$pos[$pos_n][1]] = 1;
                $result1++;
            };
        }

        // reset state variables
        $pos[0] = array(0, 0);
        $visited = array(0 => array(0 => 1));
        
        // find count for santa + robo-santa
        for ($i = 0; $i < sizeof($moves); $i++) {
            $move = $moves[$i];
            $delta = array(0, 0);

            switch ($move) {
            case '^':
                $delta = array(0, -1);
                break;
            case '>':
                $delta = array(1, 0);
                break;
            case 'v':
                $delta = array(0, 1);
                break;
            case '<':
                $delta = array(-1, 0);
                break;
            };
    
            $pos[$pos_n][0] += $delta[0];
            $pos[$pos_n][1] += $delta[1];

            if (@$visited[$pos[$pos_n][0]][$pos[$pos_n][1]] != 1) {
                $visited[$pos[$pos_n][0]][$pos[$pos_n][1]] = 1;
                $result2++;
            };

            $pos_n = ($pos_n + 1) % 2;
        };

        return array($result1, $result2);
    }
}
?>