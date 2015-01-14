<?php
/* @var $this ReservationController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->pageTitle = 'Payment - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Payment',
);
//Set report data
if (isset($_GET['month'])) {
    $month = $_GET['month'];
} else {
    $month = date('n');
}
if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $year = date('Y');
}
$totaldays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$colspan = (int) ($totaldays + 1);
?>
<h1>Payment</h1>
<div class="alert alert-danger bs-alert-old-docs">
    If you have any query please check our <?php echo CHtml::link('Frequently Asked Questions (FAQ)', array('content/faq')); ?> page.
</div>
<div class="row">
    <div class="span6">
        <h4><?php echo Content::get_title(60); ?></h4>
        <?php echo Content::get_introtext(60); ?>
    </div>
    <div class="span6">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'payment-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
        ?>
        <?php echo $form->errorSummary($model); ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'reservation_code'); ?>
            <?php echo $form->textField($model, 'reservation_code', array('class' => 'span5', 'maxlength' => 50, 'value' => Reservation::getCode(@$_REQUEST['id']))); ?>
            <?php echo $form->error($model, 'reservation_code'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'bkash_tno'); ?>
            <?php echo $form->textField($model, 'bkash_tno', array('class' => 'span5', 'maxlength' => 50)); ?>
            <?php echo $form->error($model, 'bkash_tno'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'amount'); ?>
            <?php echo $form->textField($model, 'amount', array('class' => 'span5', 'maxlength' => 10)); ?>
            <?php echo $form->error($model, 'amount'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'payment_slip'); ?>
            <?php echo $form->fileField($model, 'payment_slip', array('size' => 36, 'maxlength' => 255, 'class' => 'span5')); ?>
            <?php echo $form->error($model, 'payment_slip'); ?>
        </div>
        <div class="row buttons" style="margin-top: 20px;">
            <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary btn-large check-availability')); ?>
        </div>
        <?php $this->endWidget(); ?>  
    </div>
</div>

