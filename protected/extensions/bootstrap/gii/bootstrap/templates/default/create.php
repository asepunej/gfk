<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Create',
);\n";
?>

//$this->menu=array(
//	array('label'=>'List <?php echo $this->modelClass; ?>','url'=>array('index'), 'icon'=>'list'),
//	array('label'=>'Manage <?php echo $this->modelClass; ?>','url'=>array('admin'), 'icon'=>'cog'),
//);
?>

<div class="span1">
    <a href="<?php echo '<?php echo $this->createUrl(\'index\'); ?>'; ?>" class="aqua-shortcut text-align-center">
        <span class="modernpics newline">4</span>
        <span class="label label-info">List <?php echo $label ?></span>
    </a>
</div>
<div class="span1">
    <a href="<?php echo '<?php echo $this->createUrl(\'admin\'); ?>'; ?>" class="aqua-shortcut text-align-center">
        <span class="modernpics newline">(</span>
        <span class="label label-info">Manage <?php echo $label; ?></span>
    </a>
</div>


   <div class="span7">
    <div class="aqua-panel">
        <div class="aqua-panel-header">
            <i class="modernpics icons32">r</i><span class="panel-divider"></span>
            <h2>Create <?php echo $this->modelClass; ?><span></span></h2>
            <div class="aqua-panel-tabs-icons pull-right">
                <a href="#" class="minimize">--</a>
                <a href="#" class="modernpics maximize">v</a>
            </div>
        </div>
        <div class="aqua-panel-content">
<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
        </div>
    </div>
</div>