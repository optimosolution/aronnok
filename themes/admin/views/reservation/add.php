<?php
/* @var $this ReservationController */
/* @var $model Reservation */
?>

<?php
$this->pageTitle = 'Add Room - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Add Room',
);
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/jquery.chained.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('chain-select', " 
    $('#ReservationItem_room').chained('#ReservationItem_resort');
");
?>
<div class="widget-box">
    <div class="widget-header">
        <h5>Add Room for <?php echo User::get_user_name($_REQUEST['user']); ?></h5>
        <div class="widget-toolbar">
            <a data-action="settings" href="#"><i class="icon-cog"></i></a>
            <a data-action="reload" href="#"><i class="icon-refresh"></i></a>
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
            <a data-action="close" href="#"><i class="icon-remove"></i></a>
        </div>
    </div><!--/.widget-header -->
    <div class="widget-body">
        <div class="widget-main">
            <?php $this->renderPartial('_add', array('model' => $model)); ?>
        </div>
    </div><!--/.widget-body -->
</div><!--/.widget-box -->
