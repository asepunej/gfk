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
	'$label'=>array('index'),
	'Manage',
);\n";
?>

//$this->menu=array(
//	array('label'=>'List <?php echo $this->modelClass; ?>','url'=>array('index')),
//	array('label'=>'Create <?php echo $this->modelClass; ?>','url'=>array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    if($('.search-panel').is(':hidden')){
        $('.search-panel').slideDown('fast');
    }
    else{
        $('.search-panel').slideUp('fast');
   }
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('user-grid', {
data: $(this).serialize()
});
return false;
});
");
?>





<div class="span1">
    <a href="#" class="aqua-shortcut text-align-center search-button">
        <span class="modernpics newline">s</span>
        <span class="label label-info">Advanced Search</span>
    </a>
</div>
<div class="span1">
    <a href="<?php echo '<?php echo $this->createUrl(\'index\'); ?>'; ?>" class="aqua-shortcut text-align-center">
        <span class="modernpics newline">4</span>
        <span class="label label-info">List <?php echo $this->modelClass; ?></span>
    </a>
</div>
<div class="span1">
    <a href="<?php echo '<?php echo $this->createUrl(\'create\'); ?>'; ?>" class="aqua-shortcut text-align-center">
        <span class="modernpics newline">V</span>
        <span class="label label-info">Create <?php echo $this->modelClass; ?></span>
    </a>
</div>
<div class="clear"></div>
<div class="span7 search-panel" style="display:none">
    <div class="aqua-panel">
        <div class="aqua-panel-header">
            <i class="modernpics icons32">r</i><span class="panel-divider"></span>
            <h2>Manage <?php echo $this->pluralize($this->class2name($this->modelClass)); ?><span></span></h2>
            <div class="aqua-panel-tabs-icons pull-right">
                <a href="#" class="minimize">--</a>
                <a href="#" class="modernpics maximize">v</a>
            </div>
        </div>
        <div class="aqua-panel-content">

            <div class="search-form">
                <?php echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>\n"; ?>
            </div><!-- search-form -->
        </div>
    </div>
</div>

<div class="span7">
    <div class="aqua-panel">
        <div class="aqua-panel-header">
            <i class="modernpics icons32">r</i><span class="panel-divider"></span>
            <h2>Manage <?php echo $this->pluralize($this->class2name($this->modelClass)); ?><span></span></h2>
            <div class="aqua-panel-tabs-icons pull-right">
                <a href="#" class="minimize">--</a>
                <a href="#" class="modernpics maximize">v</a>
            </div>
        </div>
        <div class="aqua-panel-content">









            <?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbGridView',array(
            'type'=>'striped bordered condensed',
            'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
            'dataProvider'=>$model->search(),
            'template'=>'{summary}{pager}{items}{summary}{pager}',
            'filter'=>$model,
            'columns'=>array(
            <?php
            $count = 0;
            foreach ($this->tableSchema->columns as $column) {
                if (++$count == 7)
                    echo "\t\t/*\n";
                echo "\t\t'" . $column->name . "',\n";
            }
            if ($count >= 7)
                echo "\t\t*/\n";
            ?>
            array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            ),
            ),
            )); ?>

        </div>
    </div>
</div>





