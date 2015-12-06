<?
function getDayInput($day) {
    $inputUri = 'http://adventofcode.com/day/' . $day . '/input';
    $inputFile = 'input/' . $day;
    $input = '';
    $result_body = array();

    if (file_exists($inputFile)) {
        return file_get_contents($inputFile);
    } else {
        if (! @$_SERVER['AOC_SESSION_TOKEN']) {
            print "No session token defined in AOC_SESSION_TOKEN env var\n";
            exit(1);
        };
    
        print "Fetching $inputUri\n";

        $ch = curl_init($inputUri);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            // FIXME authenticate programmatically
            CURLOPT_COOKIE => 'session=' . $_SERVER['AOC_SESSION_TOKEN']
        ));
    
        $result_body = curl_exec($ch);
        $result = curl_getinfo($ch);

        if ($result['redirect_url'] != '') {
            print 'Server punted to ' . $result['redirect_url'] . "\n";
            exit(2);
        } else if ($result['http_code'] !== 200) {
            print 'Server returned HTTP ' . $result['http_code'] . "\n";
            exit(1);
        } else {
            file_put_contents($inputFile, $result_body);
            return $result_body;
        };
    };
}
?>