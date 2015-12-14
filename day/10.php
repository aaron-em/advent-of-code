<? namespace AoC;

class Day {
    public function look_say($input) {
        $result = '';
        $chars = str_split($input);
        $last = null;
        $run = 0;
        for ($i = 0; $i < sizeof($chars); $i++) {
            $char = $chars[$i];
            if ($last != $char) {
                if (!is_null($last)) {
                    $result .= $run . $last;
                }
                $last = $char;
                $run = 1;
            } else {
                $run += 1;
            }
        };
        $result .= $run . $last;
        return $result;
    }

    public function iterate($input, $count) {
        $result = $input;
        for ($i = 0; $i < $count; $i++) {
            $result = $this->look_say($result);
        };
        return $result;
    }

    public function solve_one($input, $count) {
        return (string) strlen($this->iterate($input, $count));
    }

    public function solve($input) {
        $input = preg_replace('/[^0-9]/', '', $input);
        
        return array(
            $this->solve_one($input, 40),
            $this->solve_one($input, 50)
        );
    }
}

?>