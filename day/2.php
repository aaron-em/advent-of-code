<?
$day = array(
    'tests' => array(
        '2x3x4' => array(58, 34),
        '1x1x10' => array(43, 14),
        '3x3x3' => array(63, 39)
    ),

    'solve' => function($input) {
        $result1 = 0;
        $result2 = 0;
        $lines = preg_split('/\\n/', $input);

        for ($i = 0; $i < sizeof($lines); $i++) {
            $line = $lines[$i];
            $dimensions = preg_split('/x/', $line); // length, width, height
            sort($dimensions);

            if ($dimensions[0] && $dimensions[1] && $dimensions[2]) {
                $sides = array(
                    $dimensions[0] * $dimensions[1],
                    $dimensions[1] * $dimensions[2],
                    $dimensions[2] * $dimensions[0]
                );

                // find paper slack (area of smallest side)
                $smallest_side_area = pow(2, 32);
                foreach ($sides as $side) {
                    if ($side < $smallest_side_area) {
                        $smallest_side_area = $side;
                    };
                };

                // for paper area, add package surface area, plus slack
                $result1 += (2 * $sides[0])
                          + (2 * $sides[1])
                          + (2 * $sides[2])
                          + $smallest_side_area;

                // for ribbon length, add perimeter of smallest side, plus volume
                $result2 += (2 * $dimensions[0]) + (2 * $dimensions[1])
                          + ($dimensions[0] * $dimensions[1] * $dimensions[2]);
                
            };
        }

        return array($result1, $result2);
    }
);
?>