<?
namespace AoC;

class Day {
    public function solve($input) {
        global $verbose;
        
        $result1 = null;
        $result2 = null;

        $input = preg_replace('/\r?\n/', '', $input);

        if ($verbose)
            print "Mining... (each + is 10000 hashes)\n";
        
        for ($i = 0; $i < pow(2, 32); $i++) {
            if ($verbose && ($i % 10000 == 0)) {
                print '+';
            };
            $hash_val = $input . (string) $i;
            $hash = md5($hash_val);

            if (is_null($result1) && strcmp(substr($hash, 0, 5), '00000') == 0) {
                $result1 = $i;
            };

            if (is_null($result2) && strcmp(substr($hash, 0, 6), '000000') == 0) {
                $result2 = $i;
            };

            if (!is_null($result1) && !is_null($result2)) {
                break;
            }
        };

        if ($verbose)
            print "\n";
        
        return array($result1, $result2);
    }
}
?>