<?
namespace AoC;

class Day {
    public function solve($input) {
        $result1 = null;
        $result2 = null;

        $literal_len = 0;
        $logical_len = 0;
        $escaped_len = 0;
        
        foreach (preg_split('/\n/', $input) as $line) {
            if (preg_match('/^\s*$/', $line)) continue;
            $chars = str_split($line);
            
            $literal_len += strlen($line);

            $char_count = 0;
            // offsets chosen to ignore surrounding double quotes
            for ($i = 1; $i < (sizeof($chars) - 1); $i++) {
                $char = $chars[$i];
                if ($char != '\\') {
                    // trivial case: not an escape character
                    $char_count += 1;
                    continue;
                } else {
                    $next = $chars[$i+1];
                    if ($next !== 'x') {
                        // simple case: next char is an escaped literal
                        $char_count += 1;
                        $i += 1;
                        continue;
                    } else {
                        // complex case: next char is a hex escape
                        $char_count += 1;
                        $i += 3;
                        continue;
                    };
                }
            };
            $logical_len += $char_count;

            $escaped_line = '';
            
            $escaped_line .= '"';
            for ($i = 0; $i < sizeof($chars); $i++) {
                $char = $chars[$i];
                if ($char === '\\' || $char === '"') {
                    $escaped_line .= '\\' . $char;
                } else {
                    $escaped_line .= $char;
                };
            };
            $escaped_line .= '"';
            
            $escaped_len += strlen($escaped_line);
        };

        $result1 = $literal_len - $logical_len;
        $result2 = $escaped_len - $literal_len;

        return array($result1, $result2);
    }
}
?>