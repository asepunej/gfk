<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label',
);\n";
?>

//$this->menu=array(
//array('label'=>'Create <?php echo $this->modelClass; ?>','url'=>array('create')),
//array('label'=>'Manage <?php echo $this->modelClass; ?>','url'=>array('admin')),
//);
?>


<div class="span1">
    <a href="<?php echo '<?php echo $this->createUrl(\'create\'); ?>'; ?>" class="aqua-shortcut text-align-center">
        <span class="modernpics newline">V</span>
        <span class="label label-info">Create <?php echo $this->modelClass; ?></span>
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
            <h2><?php echo $label; ?><span></span></h2>
            <div class="aqua-panel-tabs-icons pull-right">
                <a href="#" class="minimize">--</a>
                <a href="#" class="modernpics maximize">v</a>
            </div>
        </div>
        <div class="aqua-panel-content">
            <?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbListView',array(
            'dataProvider'=>$dataProvider,
            'template'=>'{summary}{pager}{items}{summary}{pager}',
            'itemView'=>'_view',
            'itemsTagName'=>'table'
            )); ?>
        </div>
    </div>
</div>
