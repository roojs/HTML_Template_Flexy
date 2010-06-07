<?php


/* Mini test suite */
require_once 'HTML/Template/Flexy.php';



function compileAll($options, $files=array()) {
    
    // loop through 
    $dh = opendir(dirname(__FILE__).'/templates/');
    while (false !== ($file = readdir($dh))) {
        if ($file{0} == '.') {
            continue;
        }
        if (is_dir(dirname(__FILE__).'/templates/'.$file)) {
            continue;
        }
        // skip if not listed in files (and it's an array)
        if ($files && !in_array($file,$files)) {
            continue;
        }
        
        $x = new HTML_Template_Flexy($options);
        echo "compile  $file \n";
        $res = $x->compile($file);
        if ($res !== true) {
            echo "Compile failure: ".$res->toString() . "\n";
        }
    }
    
}



$options =  array(
    
    'templateDir'   =>  dirname(__FILE__) .'/templates',            // where are your templates
    'forceCompile'  =>  true,  // only suggested for debugging
    'fatalError'  =>  HTML_TEMPLATE_FLEXY_ERROR_RETURN,  // only suggested for debugging
    'url_rewrite' => 'images/:/myproject/images/',
   
    
);
// basic options..

$options['compileDir']    =  dirname(__FILE__) .'/results1';


$a = $_SERVER['argv'];
array_shift($a);
if ($a) {
    $options['debug'] = 1;
    $options['fatalError']  =   HTML_TEMPLATE_FLEXY_ERROR_DIE;
}  
//compileAll($options,$a);
echo "PASS ONE: Bail out when globals / privates etc. found\n";
// test allowPHP 

$options['allowPHP']      =  true;
compileAll($options,$a);

echo "PASS TWO: Compile when globals / privates etc. found\n";
$options['compileDir']    =  dirname(__FILE__) .'/results2';
// test GLOBALS, privates etc.
$options['globals']         =  true;
$options['privates']        =  true;
$options['globalfunctions'] =  true;
$options['fatalError']  =   HTML_TEMPLATE_FLEXY_ERROR_DIE;
compileAll($options,$a);

if ($a) {
    exit;
}


/* ----- forms examples ---------*/


$x = new HTML_Template_Flexy($options);
$x->compile('forms.html');

$tmp = new StdClass;
$tmp->xyz = "testing 123";

$elements['List'] = new HTML_Template_Flexy_Element('select');
$elements['List']->setValue(2001);
$elements['picture'] = new HTML_Template_Flexy_Element('img', "width='400' height='400' src='any.gif'");


$elements['xhtmllisttest'] = new HTML_Template_Flexy_Element;
$elements['xhtmllisttest']->setOptions(array('0'=>'--select something--','bbb'=>'somevalue'));
$elements['xhtmllisttest']->setValue('bbb');


// write the data to a file.
$data = $x->bufferedOutputObject($tmp,$elements);
$fh = fopen(dirname(__FILE__) . '/results2/forms.result.html','w');
fwrite($fh,$data);
fclose($fh);


/* ----- functions examples ---------*/

echo "Compiling Function examples\n";
$x = new HTML_Template_Flexy($options);
$x->compile('function.html');

$tmp = new StdClass;
$tmp->a_value= "test1";

$data = $x->bufferedOutputObject($tmp,$elements);
$fh = fopen(dirname(__FILE__) . '/results2/function.result.html','w');
fwrite($fh,$data);
fclose($fh);


/*  ------ block examples ---------*/
echo "Compiling Block examples\n";
$x = new HTML_Template_Flexy($options);
$x->compile('blocks.html#block1');

$x = new HTML_Template_Flexy($options);
$x->compile('blocks.html#block2');


