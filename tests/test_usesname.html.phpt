--TEST--
Template Test: usestest.html
--FILE--
<?php
require_once 'testsuite.php';
require_once 'HTML/Template/Flexy/Element.php';

$elem = array();
$elem['formtest'] = &new HTML_Template_Flexy_Element(); 
$elem['formtest']->attributes['method'] = 'post'; 
$elem['formtest']->attributes['action'] = 'test'; //$_SERVER['PHP_SELF']; 

for($i = 0; $i < 10; $i++) { 
        $obj->data[$i] = $i; 
        // & might cause problems!!!??
        $elem["data$i"] = &new HTML_Template_Flexy_Element(); 
        $elem["data$i"]->attributes['type'] = 'text'; 
        $elem["data$i"]->attributes['size'] = $i; 

} 

compilefile('usesname.html', array('data'=>$obj->data),array(), $elem);

--EXPECTF--
===Compiling usesname.html===



===Compiled file: usesname.html===
<html>
  <head>
    <title>test for PEAR bug#4683</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <?php echo $this->elements['formtest']->toHtmlnoClose();?>
<?php if ($this->options['strict'] || (is_array($t->data)  || is_object($t->data))) foreach($t->data as $key => $row) {?>
      <?php echo htmlspecialchars($key);?>: <?php 
                if (!isset($this->elements[sprintf('data%s',$key)])) {
                   $this->elements[sprintf('data%s',$key)]= $this->elements['data%s'];
                }
                $this->elements[sprintf('data%s',$key)] = $this->mergeElement(
                    $this->elements['data%s'],
                    $this->elements[sprintf('data%s',$key)]
                );
                $this->elements[sprintf('data%s',$key)]->attributes['name'] = sprintf('data%s',$key);
                
                echo $this->elements[sprintf('data%s',$key)]->toHtml();?><br>
<?php }?>
    </form>
  </body>
</html>


===With data file: usesname.html===
<html>
  <head>
    <title>test for PEAR bug#4683</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <form name="formtest" method="post" action="test">      0: <input name="data0" type="text" size="0"><br>
      1: <input name="data1" type="text" size="1"><br>
      2: <input name="data2" type="text" size="2"><br>
      3: <input name="data3" type="text" size="3"><br>
      4: <input name="data4" type="text" size="4"><br>
      5: <input name="data5" type="text" size="5"><br>
      6: <input name="data6" type="text" size="6"><br>
      7: <input name="data7" type="text" size="7"><br>
      8: <input name="data8" type="text" size="8"><br>
      9: <input name="data9" type="text" size="9"><br>
    </form>
  </body>
</html>
