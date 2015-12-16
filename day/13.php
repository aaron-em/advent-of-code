<? namespace AoC;

function array_has_key($needle, $haystack) {
    return in_array($needle, array_keys($haystack), true);
};

function permute($items, $perms = array( ), &$all = array()) {
    if (empty($items)) {
        array_push($all, $perms);
    }  else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
            $newitems = $items;
            $newperms = $perms;
            list($foo) = array_splice($newitems, $i, 1);
            array_unshift($newperms, $foo);
            permute($newitems, $newperms, $all);
        }
    }

    return $all;
};

class Day {
    public function get_edges($input) {
        $values = array();
        $edges = array();
        
        foreach (preg_split('/\n/', $input) as $line) {
            $matches = array();
            preg_match('/^(\w+) would (lose|gain) (\d+).*?to (\w+)\.$/', $line, $matches);
            if (sizeof($matches) != 5) continue;
            
            $from = $matches[1];
            $value = $matches[3];
            if ($matches[2] == 'lose') $value = -$value;
            $to = $matches[4];
            
            if (! array_has_key($from, $values)) {
                $values[$from] = array();
            }
            $values[$from][$to] = $value;
        };

        foreach (array_keys($values) as $from) {
            $tos = $values[$from];
            foreach (array_keys($tos) as $to) {
                $value = $values[$from][$to];
                $value += $values[$to][$from];
                if (!array_has_key($from, $edges)) $edges[$from] = array();
                $edges[$from][$to] = $value;
                $edges[$to][$from] = $value;
                unset($values[$to][$from]);
            };
        };

        return $edges;
    }
    
    public function score_seating($seating, $edges) {
        $score = 0;

        for ($i = 0; $i < sizeof($seating); $i++) {
            $j = ($i + 1) % sizeof($seating);
            $here = $seating[$i];
            $next = $seating[$j];
            $score += $edges[$here][$next];
        }

        return $score;
    }

    public function score($input) {
        $high_score = 0;
        $edges = $this->get_edges($input);
        $names = array_keys($edges);
        $permuted_names = permute($names);
        $high_score = 0;

        foreach ($permuted_names as $seating) {
            $seating_score = $this->score_seating($seating, $edges);
            if ($seating_score > $high_score) $high_score = $seating_score;
        };

        return $high_score;
    }

    public function solve($input) {
        $names = array();
        foreach (preg_split('/\n/', $input) as $line) {
            if (preg_match('/^\s*$/', $line)) continue;
            array_push($names, explode(' ', $line)[0]);
        };
        $names = array_unique($names);
        $selfinput = $input;
        foreach ($names as $name) {
            $selfinput = "You would gain 0 happiness units by sitting next to $name.\n" . $selfinput;
            $selfinput = "$name would gain 0 happiness units by sitting next to You.\n" . $selfinput;
        };

        $result1 = $this->score($input);
        $result2 = $this->score($selfinput);

        return array($result1, $result2);
    }
}
?>