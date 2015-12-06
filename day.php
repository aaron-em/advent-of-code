<?
include('lib/getDayInput.php');

$verbose = !(@$_SERVER['RUN_BY_MAKE']);

function croak($str, $stat = 1) {
    print "$str\n";
    exit($stat);
};

$day_no = preg_replace('/\D/', '', $argv[1]);
$day_path = 'day/' . $day_no . '.php';
if (!file_exists($day_path)) {
    croak("No day for $day_no ($day_path not found)");
};

include($day_path);
$day = new AoC\Day;

$input = getDayInput($day_no);
$result = $day->solve($input);

print "Day $day_no result: " . join(', ', $result) . "\n";
?>