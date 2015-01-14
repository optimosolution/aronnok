<?php
/* @var $this ReservationController */
/* @var $model Reservation */

$this->pageTitle = 'Process - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Process',
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
<h1>Process</h1>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'reservation-grid',
    'dataProvider' => $model->search_chechout(),
    //'filter' => $model,
    'template' => '{items}',
    'columns' => array(
        array(
            'name' => 'resort',
            'type' => 'raw',
            'value' => 'Resort::getResort($data->resort)',
            'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Resort'),
        ),
        array(
            'name' => 'room',
            'type' => 'raw',
            'value' => 'Room::getRoom($data->room)',
            'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Room'),
        ),
        array(
            'name' => 'date',
            'type' => 'raw',
            'value' => 'UserAdmin::get_date($data->date)',
            'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Date'),
            'footer' => 'Total',
            'footerHtmlOptions' => array('style' => "font-weight:800;", 'title' => 'Total'),
        ),
        array(
            'name' => 'rent',
            'header' => 'Rent',
            'type' => 'raw',
            'value' => '"BDT ".number_format(Room::getRent($data->room), 2, ".", "")',
            'htmlOptions' => array('style' => "text-align:right;", 'title' => 'Rent', 'class' => 'text-right'),
            'footer' => $model->search_chechout()->itemCount === 0 ? '' : $model->getTotal($model->search_chechout()),
            'footerHtmlOptions' => array('style' => "text-align:right;font-weight:800;", 'title' => 'Total Amount', 'class' => 'text-right'),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'buttons' => array(
                'delete' => array
                    (
                    'label' => 'Delete',
                    'url' => 'Yii::app()->createUrl("reservation/remove", array("id"=>$data["id"]))',
                    'options' => array('class' => 'delete'),
                ),
            ),
        ),
    ),
));
?>
<?php echo CHtml::link('Continue', array('reservation/continue'), array('class' => 'btn btn-primary btn-large check-availability')); ?>