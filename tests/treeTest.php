<?php


/* Mini test suite */
require_once 'HTML/Template/Flexy/Tree.php';



function getAll() {
    
    // loop through 
    $ret = array();
    $dh = opendir(dirname(__FILE__).'/templates/');
    while (false !== ($file = readdir($dh))) {
        if ($file{0} == '.') {
            continue;
        }
        if (is_dir(dirname(__FILE__).'/templates/'.$file)) {
            continue;
        }
        $ret[] = $file;
    }
    return $ret;
    
}

require_once 'System.php';
System::mkdir(dirname(__FILE__)."/trees");
foreach (getAll() as $file) {
    echo "Building tree for $file\n";
    $tree =  HTML_Template_Flexy_Tree::construct(
        file_get_contents(dirname(__FILE__).'/templates/'.$file)
        );
    
    $fh = fopen(dirname(__FILE__)."/trees/{$file}.tree",'w');
    fwrite($fh, print_r($tree,true));
    fclose($fh);
    
}
// basic options..
