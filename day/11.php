<? namespace AoC;

class Day {
    public function check_rules($input) {
        $chars = str_split($input);

        $pair_chars = array();
        $pair_count = 0;

        $bad_letter = false;

        $run_count = 1;
        $max_run = 0;

        for ($i = 0; $i < sizeof($chars); $i++) {
            $char = $chars[$i];

            // rule 2 check
            if ($char == 'i' || $char == 'o' || $char == 'l') {
                $bad_letter = true;
                break;
            };

            if ($i > 0) {
                $last_char = $chars[$i-1];
                $seq_char = $last_char;
                ++$seq_char;
                while ($seq_char == 'i' || $seq_char == 'o' || $seq_char == 'l') {
                    ++$seq_char;
                };

                // rule 1 check
                if ($char == $seq_char) {
                    $run_count += 1;
                } else {
                    $run_count = 1;
                }
                if ($run_count > $max_run) $max_run = $run_count;

                // rule 3 check
                if ($char == $last_char && !in_array($char, $pair_chars)) {
                    array_push($pair_chars, $char);
                    $pair_count += 1;
                }
            };
        };

        if ($max_run < 3) return 1;
        if ($bad_letter) return 2;
        if ($pair_count < 2) return 3;
        return 0;
    }

    public function find_next($input) {
        $result = $input;
        $tries = 0;
        while ($this->check_rules($result) != 0) {
            $result++;
        }
        return $result;
    }
    
    public function solve($input) {
        $input = preg_replace('/\r?\n/', '', $input);
        
        $result1 = $this->find_next('hepxcrrq');
        $result2 = $this->find_next(++$result1);

        return array($result1, $result2);
    }
}
?>