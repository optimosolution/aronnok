<?php
/* @var $this RoomController */
/* @var $model Room */
?>

<?php
$this->pageTitle = 'Room details - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Rooms' => array('admin'),
    $model->title,
);
?>
<div class="widget-box">
    <div class="widget-header">
        <h5>Details Room (<?php echo $model->location; ?>)</h5>
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
                    array(
                        'name' => 'resort',
                        'type' => 'raw',
                        'value' => Resort::getResort($model->resort),
                    ),
                    'title',
                    array(
                        'name' => 'details',
                        'type' => 'raw',
                        'value' => $model->details,
                        'htmlOptions' => array('style' => "text-align:left;"),
                    ),
                    'rent',
                    'discount',
                    array(
                        'name' => 'picture',
                        'type' => 'raw',
                        'value' => CHtml::image(Yii::app()->baseUrl . '/uploads/images/' . $model->picture),
                    ),
                ),
            ));
            ?>
        </div>
    </div><!--/.widget-body -->
</div><!--/.widget-box -->