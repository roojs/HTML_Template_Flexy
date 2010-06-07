
<H2>GLOBALS:</H2>
<?php echo htmlspecialchars($_SESSION['hello']);?> <BR>
<?php echo htmlspecialchars($_GET['fred']);?> <BR>
<?php echo htmlspecialchars($GLOBALS['abc']);?> <BR>


<H2>Privates:</H2>
<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'_somemethod'))) echo htmlspecialchars($t->_somemethod());?> <BR>
<?php echo htmlspecialchars($t->_somevar);?> <BR>



<H2>Global methods </H2>

<?php echo htmlspecialchars(date("d/m/y"));?>   <BR>

<?php if (is_array($t->test)) { ?> <BR>
<?php }?> <BR>
<BR>

<?php if ($this->options['strict'] || (is_array($t->atest)  || is_object($t->atest))) foreach($t->atest as $k => $v) {?> <BR>
<?php if (is_array($v)) { ?> <BR>
<?php }?> <BR>
<?php }?> <BR>

