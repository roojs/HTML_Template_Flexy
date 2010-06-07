
<h2>Form Not Parsed</h2>

<form name="test">
    <input name=test123>
    <select name="aaa">
        <option>bb</option>
    </select>
</form>

<h2>Parsed</h2>


<?php echo $this->elements['test']->toHtmlnoClose();?>
    Input<?php echo $this->elements['test123']->toHtml();?>
    Checkbox <?php echo $this->elements['test123a']->toHtml();?>
    Hidden <?php echo $this->elements['test123ab']->toHtml();?>
    <?php echo $this->elements['fred']->toHtml();?>
    <?php echo $this->elements['aaa1']->toHtml();?>
    <select name="aaa2">
        <option>aa</option>
	<option selected>bb</option>
        <option>cc</option>

    </select>
    <?php echo $this->elements['aaa3']->toHtml();?>
    
    
    
    
    <?php echo $this->elements['List']->toHtml();?>
    <?php echo $this->elements['_submit[4]']->toHtml();?>
    <?php echo $this->elements['_submit[5]']->toHtml();?>
    
    <?php echo $this->elements['testupload']->toHtml();?>
</form>

<?php echo $this->elements['picture']->toHtml();?>

<h2>Bug 1120:</h2>
<form action="test">
<?php echo $this->elements['testing']->toHtml();?>
<?php echo $this->elements['_submit[2]']->toHtml();?>
</form>

<form action="<?php echo htmlspecialchars($t->someurl);?>">
<?php 
if (!isset($this->elements['testing2']->attributes['value'])) {
    $this->elements['testing2']->attributes['value'] = '';
    $this->elements['testing2']->attributes['value'] .=  htmlspecialchars($t->somevalue);
}
$_attributes_used = array('value');
echo $this->elements['testing2']->toHtml();
if (isset($_attributes_used)) {  foreach($_attributes_used as $_a) {
    unset($this->elements['testing2']->attributes[$_a]);
}}
?>
<?php echo $this->elements['_submit[1]']->toHtml();?>
</form>

<H2> Bug 1275 XHTML output </H2>
<?php echo $this->elements['testingxhtml']->toHtml();?>
<?php echo $this->elements['xhtmllisttest']->toHtml();?>



<?php 
if (!isset($this->elements['test_mix']->attributes['action'])) {
    $this->elements['test_mix']->attributes['action'] = '';
    $this->elements['test_mix']->attributes['action'] .=  htmlspecialchars($t->someurl);
}
$_attributes_used = array('action');
echo $this->elements['test_mix']->toHtmlnoClose();
if (isset($_attributes_used)) {  foreach($_attributes_used as $_a) {
    unset($this->elements['test_mix']->attributes[$_a]);
}}
?>
<?php 
if (!isset($this->elements['testing5']->attributes['value'])) {
    $this->elements['testing5']->attributes['value'] = '';
    $this->elements['testing5']->attributes['value'] .=  htmlspecialchars($t->somevalue);
}
$_attributes_used = array('value');
echo $this->elements['testing5']->toHtml();
if (isset($_attributes_used)) {  foreach($_attributes_used as $_a) {
    unset($this->elements['testing5']->attributes[$_a]);
}}
?>
<?php echo $this->elements['_submit[3]']->toHtml();?>
</form>
