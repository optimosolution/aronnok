<?php
/* @var $this ReservationController */
/* @var $model Reservation */

$this->pageTitle = 'Reservations - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Reservations' => array('admin'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#reservation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="widget-box">
    <div class="widget-header">
        <h5>Manage Reservations</h5>
        <div class="widget-toolbar">
            <a data-action="settings" href="#"><i class="icon-cog"></i></a>
            <a data-action="reload" href="#"><i class="icon-refresh"></i></a>
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
            <a data-action="close" href="#"><i class="icon-remove"></i></a>
        </div>
        <div class="widget-toolbar">
            <?php echo CHtml::link('<i class="icon-search"></i>', '#', array('class' => 'search-button', 'data-rel' => 'tooltip', 'title' => 'Search', 'data-placement' => 'bottom')); ?>
        </div>
    </div><!--/.widget-header -->
    <div class="widget-body">
        <div class="widget-main">
            <div class="search-form" style="display:none">
                <?php
                $this->renderPartial('_search', array(
                    'model' => $model,
                ));
                ?>
            </div><!-- search-form -->
            <?php
            $this->widget('bootstrap.widgets.TbGridView', array(
                'id' => 'reservation-grid',
                'dataProvider' => $model->search(),
                'filter' => $model,
                'columns' => array(
//                    array(
//                        'name' => 'id',
//                        'type' => 'raw',
//                        'value' => '$data->id',
//                        'htmlOptions' => array('style' => "text-align:center;width:80px;", 'title' => 'ID'),
//                    ),
                    array(
                        'name' => 'user',
                        'value' => 'User::get_user_name($data->user)',
                        'filter' => CHtml::activeDropDownList($model, 'user', CHtml::listData(User::model()->findAll(array('condition' => '', "order" => "name")), 'id', 'name'), array('empty' => 'All')),
                        'htmlOptions' => array('style' => "text-align:left;"),
                    ),
                    array(
                        'name' => 'reservation_code',
                        'value' => '$data->reservation_code',
                        'htmlOptions' => array('style' => "text-align:left;width:150px;"),
                    ),
                    array(
                        'name' => 'booking_date',
                        'type' => 'raw',
                        'value' => 'UserAdmin::get_date($data->booking_date)',
                        'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Booking Date'),
                    ),
                    array(
                        'header' => 'Amount',
                        'type' => 'raw',
                        'value' => 'ReservationItem::getTotalAmount($data->id)',
                        'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Total Amount'),
                    ),
                    array(
                        'name' => 'status',
                        'type' => 'raw',
                        'value' => 'ReservationStatus::getStatus($data->status)',
                        'filter' => CHtml::activeDropDownList($model, 'status', CHtml::listData(ReservationStatus::model()->findAll(array('condition' => '', "order" => "title")), 'id', 'title'), array('empty' => 'All')),
                        'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Status'),
                    ),
                    array(
                        'class' => 'bootstrap.widgets.TbButtonColumn',
                    //'template' => '{view}{delete}',
                    ),
                ),
            ));
            ?>
        </div>
    </div><!--/.widget-body -->
</div><!--/.widget-box -->