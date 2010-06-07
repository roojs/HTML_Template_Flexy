<?php


    $dh = opendir(dirname(__FILE__).'/templates/');
    $id = 0;
    while (false !== ($file = readdir($dh))) {
        if ($file{0} == '.') {
            continue;
        }
        if (is_dir(dirname(__FILE__).'/templates/'.$file)) {
            continue;
        }
        $id++;
        $test = dirname(__FILE__)."/test_{$file}.phpt";
        if (file_exists($test)) {
            continue;
        }
        $stub = "--TEST--
Template Test: $file
--FILE--
<?php
require_once 'testsuite.php';
compilefile('$file');

--EXPECTF--
";
        $fh = fopen($test,"w");
        fwrite($fh, $stub);
        fclose($fh);
    }



   