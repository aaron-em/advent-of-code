<?
$day = array(
    'tests' => array(
        'ugknbfddgicrmopn' => array(1, 0),
        'aaa' => array(1, 0),
        'jchzalrnumimnmhp' => array(0, 0),
        'haegwjzuvuyypxyu' => array(0, 0),
        'dvszwmarrgswjxmb' => array(0, 0),
        "aaa\neee\naxy\n" => array(2, 0),
        "qjhvhtzxzqqjkmpb" => array(0, 1),
        "xxyxx" => array(0, 1)
    ),

    'solve' => function($input) {
        $result1 = 0; // nice count
        $result2 = 0;

        $lines = preg_split('/\r?\n/', $input);
        foreach ($lines as $line) {
            $chars = str_split($line);
            $vowels = 0;
            $goodpair = false;
            $badpair = false;

            // scan string and gather information needed to test part 1 rules
            for ($i = 0; $i < sizeof($chars); $i++) {
                $char = $chars[$i];
                $prev = ($i > 0 ? $chars[$i-1] : null);

                // check for a vowel; if found, splice it out of the list
                switch ($char) {
                case 'a':
                case 'e':
                case 'i':
                case 'o':
                case 'u':
                    $vowels += 1;
                    break;
                };

                // check pairs, once we're far enough into the string
                if (! is_null($prev)) {
                    // check for a "nice" pair (2 in a row)
                    if ($char === $prev) {
                        $goodpair = true;
                    };
                    
                    // check for a "naughty" pair (one of those listed)
                    switch ($prev . $char) {
                    case 'ab':
                    case 'cd':
                    case 'pq':
                    case 'xy':
                        $badpair = true;
                        break;
                    default:
                        break;
                    };
                };
            };

            // try to fail each part 1 rule in turn
            do {
                // not enough vowels
                if ($vowels < 3) break;
                // doesn't have a good pair
                if ($goodpair === false) break;
                // does have a bad pair
                if ($badpair === true) break;

                // if we couldn't fail any rules, increment the good count
                $result1 += 1;
            } while (false);

            // try to fail each part 2 rule in turn, as above
            do {
                // lacks two non-overlapping instances of a pair
                if (! preg_match('/(..).*?\1/', $line)) break;
                // lacks an ABA triad
                if (! preg_match('/(.).\1/', $line)) break;

                // if none fail, bump the count
                $result2 += 1;
            } while (false);
        };

        return array($result1, $result2);
    }
);
?>