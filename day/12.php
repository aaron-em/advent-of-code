<? namespace AoC;

class Day {
    public function sum($json_str, $redless = false) {
        $json = json_decode($json_str);
        return $this->sum_part($json, $redless);
    }

    public function sum_part($part, $redless = false) {
        $sum = 0;

        if (is_array($part)) {
            foreach (array_values($part) as $val) {
                $sum += $this->sum_part($val, $redless);
            };
        } else if (is_object($part)) {
            $content = get_object_vars($part);
            $has_red = in_array('red', array_values($content), true);
            $ignore_part = $redless && $has_red;
            
            if (! $ignore_part) {
                $sum += $this->sum_part($content, $redless);
            }
        } else if (is_numeric($part)) {
            $sum += $part;
        }

        return $sum;
    }
    
    public function solve($input) {
        $result1 = $this->sum($input);
        $result2 = $this->sum($input, true);

        return array($result1, $result2);
    }
}
?>