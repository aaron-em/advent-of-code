<?
namespace AoC;

class Day {
    public function solve($input) {
        $chars = str_split($input);
        $result1 = 0;
        $result2 = null;
        for ($i = 0; $i < sizeof($chars); $i++) {
            $char = $chars[$i];
            if ($char == '(') {
                $result1 += 1;
            } else if ($char == ')') {
                $result1 -= 1;
                if ($result2 == null && $result1 < 0) {
                    $result2 = $i + 1;
                };
            } else {
                throw new ErrorException("Invalid character '" . $char . "' in input at offset " . $i);
            }
        };

        return array($result1, $result2);
    }
}
?>