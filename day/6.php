<?
namespace AoC;

class Day {
    public function decompose($instruction) {
        $transform = array();

        // turn the textual instruction into values we can use:
        $parts = preg_split('/\s+/', $instruction);
        // condense 'turn on' and 'turn off' back to a single part
        if (sizeof($parts) == 5) {
            $parts[0] = $parts[0] . ' ' . $parts[1];
            array_splice($parts, 1, 1);
        };
        // remove 'through'
        array_splice($parts, 2, 1);
        // convert instruction type to transform value
        switch($parts[0]) {
        case 'turn on':
            $parts[0] = 1;
            break;
        case 'turn off':
            $parts[0] = 0;
            break;
        case 'toggle':
            $parts[0] = -1;
            break;
        };
        // convert coordinate strings to pairs
        for ($i = 1; $i <= 2; $i++) {
            $parts[$i] = explode(',', $parts[$i]);
        };

        // at this point:
        // - parts[0] is the transform value
        // - parts[1] is the upper-left corner of the transform region
        // - parts[2] is the lower-right corner of " " "

        // find the dimension of the transform
        $transform_dim = array(
            $parts[2][0] - $parts[1][0],
            $parts[2][1] - $parts[1][1]
        );

        for ($i = 0; $i <= $transform_dim[1]; $i++) {
            $transform[$i] = array_fill(0, $transform_dim[0]+1, $parts[0]);
        };

        // $corner: the top-left one, so we know where to start
        return array($parts[1], $transform);
    }

    public function apply_switches($grid, $corner, $transform) {
        $gx = $corner[0] - 1;
        $gy = $corner[1] - 1;

        foreach ($transform as $t_row) {
            foreach ($t_row as $t_val) {
                $g_val = $grid[$gy][$gx];
                $grid[$gy][$gx] = ($t_val > -1 ? $t_val : abs($g_val + $t_val));
                $gx += 1;
            };
            $gx = $corner[0] - 1;
            $gy += 1;
        };
    
        return $grid;
    }

    public function apply_brightness($grid, $corner, $transform) {
        $gx = $corner[0] - 1;
        $gy = $corner[1] - 1;

        foreach ($transform as $t_row) {
            foreach ($t_row as $t_val) {
                $g_val = $grid[$gy][$gx];
                switch ($t_val) {
                case 1: break;
                case 0: $t_val = -1; break;
                case -1: $t_val = 2; break;
                };
                $grid[$gy][$gx] = max(0, $g_val + $t_val);
                $gx += 1;
            };
            $gx = $corner[0] - 1;
            $gy += 1;
        };
    
        return $grid;
    }

    public function total($grid) {
        $lit = 0;
        foreach ($grid as $row) {
            $lit += array_sum($row);
        };
        return $lit;
    }

    public function solve($input) {
        $result1 = 0;
        $result2 = null;
        
        $grid1 = array();
        for ($i = 0; $i < 1000; $i++) {
            $grid1[$i] = array_fill(0, 1000, 0);
        };

        $grid2 = array();
        for ($i = 0; $i < 1000; $i++) {
            $grid2[$i] = array_fill(0, 1000, 0);
        };

        foreach (preg_split('/\n/', $input) as $line) {
            if (preg_match('/^\s*$/', $line)) continue;
            $rule = $this->decompose($line);
            $grid1 = $this->apply_switches($grid1, $rule[0], $rule[1]);
            $grid2 = $this->apply_brightness($grid2, $rule[0], $rule[1]);
        };

        $result1 = $this->total($grid1);
        $result2 = $this->total($grid2);

        return array($result1, $result2);
    }
}
?>