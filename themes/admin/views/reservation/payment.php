<?php
/* @var $this ReservationController */
/* @var $model Reservation */
?>

<?php
$this->pageTitle = 'Payment - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Payment',
);
?>
<div class="widget-box">
    <div class="widget-header">
        <h5>Payment for <?php echo User::get_user_name($_REQUEST['user']); ?>, Reservation Code: <?php echo Reservation::getCode($_REQUEST['id']); ?></h5>
        <div class="widget-toolbar">
            <a data-action="settings" href="#"><i class="icon-cog"></i></a>
            <a data-action="reload" href="#"><i class="icon-refresh"></i></a>
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
            <a data-action="close" href="#"><i class="icon-remove"></i></a>
        </div>
    </div><!--/.widget-header -->
    <div class="widget-body">
        <div class="widget-main">
            <?php $this->renderPartial('_payment', array('model' => $model)); ?>
        </div>
    </div><!--/.widget-body -->
</div><!--/.widget-box -->
