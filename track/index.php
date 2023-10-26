<?php
if (isset($_SERVER["HTTP_XHPROF"])) {
    xhprof_enable();

    include 'index.php.bak';

    $data = xhprof_disable();

    // Here need defind XHPROF_ROOT
    $XHPROF_ROOT = dirname(dirname(dirname(dirname(__FILE__)))) . '/tools/local.xhprof.com';
    $XHPROF_DOMAIN = 'http://local.xhprof.com';
    require_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
    require_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";

    $objXhprofRun = new XHProfRuns_Default();
    $tag = str_replace('.', '_', $_SERVER["HTTP_HOST"]) . date('Y-m-d_H_i_s', time());
    $run_id = $objXhprofRun->save_run($data, $tag);
    $url = $XHPROF_DOMAIN . '/index.php?source=' .$tag  . '&run=' . $run_id;
    if (isset($_SERVER["HTTP_XHPROF_JUMP"])) {
        echo '<a target="_blank" href="' . $url . '">' . $run_id . '</a>';
    }
} else {
    include 'index.php.bak';
}
