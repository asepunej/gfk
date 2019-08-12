<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn = $this->guessNameColumn($this->tableSchema->columns);
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>

//$this->menu=array(
//array('label'=>'List <?php echo $this->modelClass; ?>','url'=>array('index')),
//array('label'=>'Create <?php echo $this->modelClass; ?>','url'=>array('create')),
//array('label'=>'Update <?php echo $this->modelClass; ?>','url'=>array('update','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
//array('label'=>'Delete <?php echo $this->modelClass; ?>','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Are you sure you want to delete this item?')),
//array('label'=>'Manage <?php echo $this->modelClass; ?>','url'=>array('admin')),
//);
?>


<div class="span1">
    <a href="<?php echo '<?php echo $this->createUrl(\'index\'); ?>'; ?>" class="aqua-shortcut text-align-center">
        <span class="modernpics newline">4</span>
        <span class="label label-info">List <?php echo $label ?></span>
    </a>
</div>
<div class="span1">
    <a href="<?php echo '<?php echo $this->createUrl(\'create\'); ?>'; ?>" class="aqua-shortcut text-align-center">
        <span class="modernpics newline">V</span>
        <span class="label label-info">Create <?php echo $this->modelClass; ?></span>
    </a>
</div>

<div class="span1">
    <a href="<?php echo '<?php echo $this->createUrl(\'update\', array(\'id\'=>$model->'.$this->tableSchema->primaryKey.')); ?>'; ?>" class="aqua-shortcut text-align-center">
        <span class="modernpics newline">r</span>
        <span class="label label-info">Update</span>
    </a>
</div>
<div class="span1">
    <a href="<?php echo '<?php echo $this->createUrl(\'admin\'); ?>'; ?>" class="aqua-shortcut text-align-center">
        <span class="modernpics newline">(</span>
        <span class="label label-info">Manage <?php echo $label; ?></span>
    </a>
</div>

<div class="span1">
  <?php echo '<?php echo CHtml::link(\'<span class="modernpics newline icons-red">x</span><span class="label label-inverse">Delete</span>\', \'#\', array(\'class\'=>\'aqua-shortcut text-align-center delete\',\'submit\' => array(\'delete\', \'id\' => $model->id), \'confirm\' => \'Are you sure you want to delete this item?\')); ?>'; ?>
</div>


<div class="span7">
    <div class="aqua-panel">
        <div class="aqua-panel-header">
            <i class="modernpics icons32">r</i><span class="panel-divider"></span>
            <h2>View <?php echo $this->modelClass . " #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?><span></span></h2>
            <div class="aqua-panel-tabs-icons pull-right">
                <a href="#" class="minimize">--</a>
                <a href="#" class="modernpics maximize">v</a>
            </div>
        </div>
        <div class="aqua-panel-content">
            <?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbDetailView',array(
            'data'=>$model,
            'attributes'=>array(
            <?php
            foreach ($this->tableSchema->columns as $column)
                echo "\t\t'" . $column->name . "',\n";
            ?>
            ),
            )); ?>
        </div>
    </div>
</div>