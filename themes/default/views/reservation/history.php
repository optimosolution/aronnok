<?php
/* @var $this ReservationController */
/* @var $model Reservation */

$this->pageTitle = 'History - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'History',
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
<h1>History</h1>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'reservation-grid',
    'dataProvider' => $model->search_history(),
    //'filter' => $model,
    'template' => '{items}',
    'columns' => array(
        array(
            'name' => 'reservation_code',
            'type' => 'raw',
            'value' => '$data->reservation_code',
            'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Reservation Code'),
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
            'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Status'),
        ),
        array(
            'header' => 'Action',
            'type' => 'raw',
            'value' => 'Reservation::checkAction($data->id)',
            'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Actions'),
        ),
    ),
));
?>