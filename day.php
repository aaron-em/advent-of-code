<?
include('lib/getDayInput.php');

function croak($str, $stat = 1) {
    print "$str\n";
    exit($stat);
};

$verbose = !(@$_SERVER['RUN_BY_MAKE']);

$day_no = preg_replace('/\D/', '', $argv[1]);
$day_path = 'day/' . $day_no . '.php';
if (!file_exists($day_path)) {
    croak("No day for $day_no ($day_path not found)");
};

include($day_path);
if (! @is_array($day)) {
    croak("Day $day_no doesn't define \$day as an array");
};

if (! @is_array($day['tests'])) {
    croak("Day $day_no doesn't define \$day['tests'] as an array");
};

if (! @is_callable($day['solve'])) {
    croak("Day $day_no doesn't define \$day['solve'] as a function");
};

set_error_handler(function($errno, $errstr, $errfile, $errline) {
    croak("Error in $errfile, line $errline: $errstr");
}, E_ALL);

if ($verbose) print "Day $day_no: running tests\n";
if ($verbose) print "1.." . sizeof($day['tests']) . "\n";
$test_no = 0;
$test_fails = 0;
foreach (array_keys($day['tests']) as $test_case) {
    $test_no += 1;
    $test_expected = $day['tests'][$test_case];
    $test_result = $day['solve']($test_case);
    $this_test_fails = false;

    if ($test_expected != $test_result) {
        $test_fails += 1;
        $this_test_fails = true;
        print "not ";
    };

    if ($this_test_fails || $verbose)
        print "ok $test_no - " . preg_replace('/\n/', '\\n', $test_case);
    
    if ($test_expected != $test_result) {
        print " (expected (" . join(', ', $test_expected) . ")". 
                             ", got (" . join(', ', $test_result) . ")";
    };

    if ($this_test_fails || $verbose)
        print "\n";
};

if ($test_fails != 0) {
    croak("Not all tests passed; bailing");
};

$result = $day['solve'](getDayInput($day_no));
print "Day $day_no result: " . join(', ', $result) . "\n";
?>