<?php
/* @var $this ResortController */
/* @var $model Resort */
?>

<?php
$this->pageTitle = 'Resort details - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Resorts' => array('admin'),
    $model->resort,
);
?>
<div class="widget-box">
    <div class="widget-header">
        <h5>Details resort (<?php echo $model->resort; ?>)</h5>
        <div class="widget-toolbar">
            <a data-action="settings" href="#"><i class="icon-cog"></i></a>
            <a data-action="reload" href="#"><i class="icon-refresh"></i></a>
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
            <a data-action="close" href="#"><i class="icon-remove"></i></a>
        </div>
        <div class="widget-toolbar">
            <?php echo CHtml::link('<i class="icon-pencil"></i>', array('update', 'id' => $model->id), array('data-rel' => 'tooltip', 'title' => 'Edit', 'data-placement' => 'bottom')); ?>
        </div>
        <div class="widget-toolbar">
            <?php echo CHtml::link('<i class="icon-plus"></i>', array('create'), array('data-rel' => 'tooltip', 'title' => 'Add', 'data-placement' => 'bottom')); ?>
        </div>
    </div><!--/.widget-header -->
    <div class="widget-body">
        <div class="widget-main">
            <?php
            $this->widget('zii.widgets.CDetailView', array(
                'htmlOptions' => array(
                    'class' => 'table table-striped table-condensed table-hover',
                ),
                'data' => $model,
                'attributes' => array(
                    'id',
                    array(
                        'name' => 'location',
                        'type' => 'raw',
                        'value' => Location::getLocation($model->location),
                    ),
                    'resort',
                    array(
                        'name' => 'details',
                        'type' => 'raw',
                        'value' => $model->details,
                        'htmlOptions' => array('style' => "text-align:left;"),
                    ),
                    array(
                        'name' => 'picture',
                        'type' => 'raw',
                        'value' => CHtml::image(Yii::app()->baseUrl . '/uploads/images/' . $model->picture),
                    ),
                    array(
                        'name' => 'map',
                        'type' => 'raw',
                        'value' => $model->map,
                        'htmlOptions' => array('style' => "text-align:left;"),
                    ),
                ),
            ));
            ?>
        </div>
    </div><!--/.widget-body -->
</div><!--/.widget-box -->