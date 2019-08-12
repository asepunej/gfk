<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<tr class="view">
<td>
    <table class="table table-striped table-condensed">
       
<?php
echo "\t <tr><th><?php echo CHtml::encode(\$data->getAttributeLabel('{$this->tableSchema->primaryKey}')); ?>:</th>\n";
echo "\t<td><?php echo CHtml::link(CHtml::encode(\$data->{$this->tableSchema->primaryKey}),array('view','id'=>\$data->{$this->tableSchema->primaryKey})); ?>\n\t</td></tr>\n\n";
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if($column->isPrimaryKey)
		continue;
	if(++$count==7)
		echo "\t<?php /*\n";
	echo "\t<tr><th><?php echo CHtml::encode(\$data->getAttributeLabel('{$column->name}')); ?>:</th>\n";
	echo "\t<td><?php echo CHtml::encode(\$data->{$column->name}); ?>\n\t</td></tr>\n\n";
}
if($count>=7)
	echo "\t*/ ?>\n";
?>
    </table>
</td>
</tr>