<? namespace AoC;

class Day {
    public function prep_race($input) {
        $race = array();
        
        foreach (preg_split('/\n/', $input) as $line) {
            if (preg_match('/^\s*$/', $line)) continue;
            $matches = array();
            preg_match('/^(\w+).*?(\d+).*?(\d+).*?(\d+)/', $line, $matches);
            $race[$matches[1]] = array_map(function ($s) { return (int) $s; },
                                           array_slice($matches, 2, 3));
        };

        return $race;
    }

    public function make_steps($race) {
        $steps = array();

        foreach (array_keys($race) as $runner) {
            $runner_data = $race[$runner];
            
            $steps[$runner] = array_merge(
                array_fill(0, $runner_data[1], $runner_data[0]),
                array_fill(0, $runner_data[2], 0)
            );
        };

        return $steps;
    }

    public function run_race($race, $length) {
        $steps = $this->make_steps($race);
        $step_len = array();
        $step_ptr = array();
        $state = array();
        $furthest_run = 0;

        foreach (array_keys($steps) as $runner) {
            $state[$runner] = 0;
            $step_ptr[$runner] = 0;
            $step_len[$runner] = sizeof($steps[$runner]);
        };

        for ($i = 0; $i < $length; $i++) {
            foreach (array_keys($steps) as $runner) {
                $state[$runner] += $steps[$runner][$step_ptr[$runner]];
                $step_ptr[$runner] = ($step_ptr[$runner] + 1) % $step_len[$runner];
                if ($state[$runner] > $furthest_run) $furthest_run = $state[$runner];
            };
        };

        return $furthest_run;
    }

    public function run_leader($race, $length) {
        $steps = $this->make_steps($race);
        $step_len = array();
        $step_ptr = array();
        $state = array();
        $scores = array();
        $high_score = 0;

        foreach (array_keys($steps) as $runner) {
            $state[$runner] = 0;
            $step_ptr[$runner] = 0;
            $step_len[$runner] = sizeof($steps[$runner]);
            $scores[$runner] = 0;
        };

        for ($i = 0; $i < $length; $i++) {
            foreach (array_keys($steps) as $runner) {
                $state[$runner] += $steps[$runner][$step_ptr[$runner]];
                $step_ptr[$runner] = ($step_ptr[$runner] + 1) % $step_len[$runner];
            };

            arsort($state);
            $lead = array_values($state)[0];
            foreach (array_keys($state) as $runner) {
                if ($state[$runner] == $lead) $scores[$runner] += 1;
                if ($scores[$runner] > $high_score) $high_score = $scores[$runner];
            };
        };

        return $high_score;
    }
    
    public function solve($input) {
        $race = $this->prep_race($input);
        $result1 = $this->run_race($race, 2503);
        $result2 = $this->run_leader($race, 2503);

        return array($result1, $result2);
    }
}
?>