<?php
error_reporting(E_ALL);
/**
 * Sample summary line.
 *
 * Next paragraph. Etc.
 */
xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
//$a = 5;
$b = 10;
$c = $a + $b;
//$summ = 0;
//echo $c;
//echo phpinfo();

function mysumm($field) {
    return $summ = $field+15;
}
echo mysumm(15);
$xhprof_data = xhprof_disable();
include_once "/var/www/xhprof-0.9.4/xhprof_lib/utils/xhprof_lib.php";
include_once "/var/www/xhprof-0.9.4/xhprof_lib/utils/xhprof_runs.php";
$xhprof_runs = new XHProfRuns_Default();
$run_id = $xhprof_runs->save_run($xhprof_data, "test");

