<?php
/* @var $this ReservationController */
/* @var $model Reservation */
?>

<?php
$this->pageTitle = 'Reservation details - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Reservations' => array('admin'),
    $model->reservation_code,
);
?>
<div class="widget-box">
    <div class="widget-header">
        <h5>Details Reservation (Reservation Code: <?php echo $model->reservation_code; ?>)</h5>
        <div class="widget-toolbar">            
            <a data-action="settings" href="#"><i class="icon-cog"></i></a>
            <a data-action="reload" href="#"><i class="icon-refresh"></i></a>
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
            <a data-action="close" href="#"><i class="icon-remove"></i></a>
        </div>
    </div><!--/.widget-header -->
    <div class="widget-body">
        <div class="widget-main">
            <div class="user-profile row-fluid">
                <div class="tabbable">
                    <ul class="nav nav-tabs padding-18">
                        <li class="active">
                            <a data-toggle="tab" href="#home">
                                <i class="green icon-home bigger-120"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#Booking">
                                <i class="orange icon-rss bigger-120"></i>
                                Booking Details
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#Payment">
                                <i class="orange icon-rss bigger-120"></i>
                                Payment
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content no-border padding-24">
                        <div id="home" class="tab-pane in active">
                            <div class="row-fluid">
                                <div class="span12">
                                    <?php
                                    $this->widget('zii.widgets.CDetailView', array(
                                        'htmlOptions' => array(
                                            'class' => 'table table-striped table-condensed table-hover',
                                        ),
                                        'data' => $model,
                                        'attributes' => array(
                                            'id',
                                            array(
                                                'name' => 'user',
                                                'type' => 'raw',
                                                'value' => User::get_user_name($model->user),
                                            ),
                                            'reservation_code',
                                            array(
                                                'name' => 'booking_date',
                                                'type' => 'raw',
                                                'value' => UserAdmin::get_date($model->booking_date),
                                            ),
                                            array(
                                                'label' => 'Amount',
                                                'type' => 'raw',
                                                'value' => ReservationItem::getTotalAmount($model->id),
                                            ),
                                            array(
                                                'name' => 'booking_date',
                                                'type' => 'raw',
                                                'value' => ReservationStatus::getStatus($model->status),
                                            ),
                                        ),
                                    ));
                                    ?>                                    
                                </div><!-- /span -->
                            </div><!-- /row-fluid -->
                        </div><!-- #home -->
                        <div id="Booking" class="tab-pane">
                            <div class="row-fluid">
                                <div class="span12">
                                    <?php
                                    $this->widget('bootstrap.widgets.TbGridView', array(
                                        'id' => 'reservation-item-grid',
                                        'dataProvider' => $modelr->search($model->id),
                                        'filter' => $modelr,
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
                                                'footer' => $modelr->search($model->id)->itemCount === 0 ? '' : $modelr->getTotal($modelr->search($model->id)),
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
                                </div><!-- /span -->
                            </div><!-- /row -->
                        </div>
                        <div id="Payment" class="tab-pane">
                            <div class="row-fluid">
                                <div class="span12">
                                    <?php
                                    $assetsDir = dirname(__FILE__) . '/../uploads/images';
                                    $this->widget('bootstrap.widgets.TbGridView', array(
                                        'id' => 'payment-grid',
                                        'dataProvider' => $modelp->search($model->reservation_code),
                                        'filter' => $modelp,
                                        'template' => '{items}',
                                        'columns' => array(
                                            array(
                                                'name' => 'reservation_code',
                                                'type' => 'raw',
                                                'value' => '$data->reservation_code',
                                                'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Reservation Code'),
                                            ),
                                            array(
                                                'name' => 'bkash_tno',
                                                'type' => 'raw',
                                                'value' => '$data->bkash_tno',
                                                'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Bkash TrxID'),
                                            ),
                                            array(
                                                'name' => 'amount',
                                                'type' => 'raw',
                                                'value' => '$data->amount',
                                                'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Amount'),
                                            ),
                                            array(
                                                'name' => 'dates',
                                                'type' => 'raw',
                                                'value' => 'UserAdmin::get_date($data->dates)',
                                                'htmlOptions' => array('style' => "text-align:left;", 'title' => 'Date'),
                                            ),
                                            array(
                                                'name' => 'payment_slip',
                                                'type' => 'html',
                                                'value' => 'Payment::get_payment_slip($data->id)',
                                                'htmlOptions' => array('style' => "text-align:left;width:50px;", 'title' => 'Slip', 'class' => 'ace-thumbnails'),
                                            ),
                                        ),
                                    ));
                                    ?>
                                </div><!-- /span -->
                            </div><!-- /row -->
                        </div>
                    </div>
                    <?php echo CHtml::link('<i class="icon-edit"></i> Change Status', array('update', 'id' => $model->id), array('class' => 'btn btn-small btn-info')); ?>
                    <?php echo CHtml::link('<i class="icon-plus"></i> Add Room', array('add', 'id' => $model->id, 'user' => $model->user), array('class' => 'btn btn-small btn-primary')); ?>
                    <?php echo CHtml::link('<i class="icon-shopping-cart"></i> Add Payment', array('payment', 'id' => $model->id, 'user' => $model->user), array('class' => 'btn btn-small btn-primary')); ?>
                </div>
            </div>            
        </div>
    </div><!--/.widget-body -->
</div><!--/.widget-box -->