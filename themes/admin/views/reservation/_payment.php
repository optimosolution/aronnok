<?php
/* @var $this ReservationController */
/* @var $model Reservation */
/* @var $form TbActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'reservation-item-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
Yii::app()->clientScript->registerScript('search', "
    $('#Payment_payment_slip').ace_file_input({
        no_file: 'No Slip ...',
        btn_choose: 'Choose',
        btn_change: 'Change',
        droppable: false,
        onchange: null,
        thumbnail: false //| true | large
                //whitelist:'gif|png|jpg|jpeg'
                //blacklist:'exe|php'
                //onchange:''
                //
    });
");
?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldControlGroup($model, 'reservation_code', array('class' => 'span5', 'maxlength' => 50, 'value' => Reservation::getCode($_REQUEST['id']), 'readonly' => 'readonly')); ?>
<?php echo $form->textFieldControlGroup($model, 'bkash_tno', array('class' => 'span5', 'maxlength' => 50)); ?>
<?php echo $form->textFieldControlGroup($model, 'amount', array('class' => 'span5', 'maxlength' => 10)); ?>
<div class="row-fluid">
    <div class="span5">
        <?php echo $form->fileFieldControlGroup($model, 'payment_slip', array('maxlength' => 255, 'class' => 'span5')); ?>
    </div>
</div>
<div class="form-actions">
    <?php
    echo TbHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save', array(
        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
        'size' => TbHtml::BUTTON_SIZE_LARGE,
    ));
    ?>
</div>
<?php $this->endWidget(); ?>