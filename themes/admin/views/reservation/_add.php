<?php
/* @var $this ReservationController */
/* @var $model Reservation */
/* @var $form TbActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'reservation-item-form',
    'enableAjaxValidation' => false,
        ));
?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->dropDownListControlGroup($model, 'resort', CHtml::listData(Resort::model()->findAll(array('condition' => '', "order" => "resort")), 'id', 'resort'), array('empty' => '--select resort--', 'class' => 'span5')); ?>
<?php echo $form->dropDownListControlGroup($model, 'room', CHtml::listData(Room::model()->findAll(array('condition' => '', "order" => "title")), 'id', 'title'), array('empty' => '--select room--', 'class' => 'span5')); ?>
<div class="row-fluid">
    <div class="span3">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php
        echo $form->widget('zii.widgets.jui.CJuiDatePicker', array(
            'language' => 'en',
            'model' => $model, // Model object
            'attribute' => 'date',
            'options' => array(
                'mode' => 'date',
                'changeYear' => true,
                'changeMonth' => true,
                'yearRange' => '2014:2050',
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => '',
                'showTimepicker' => false,
            ),
            'htmlOptions' => array(
                'placeholder' => 'Date',
                'class' => 'span12',
            ),
                ), true);
        ?>
    </div>
</div>
<div class="form-actions">
    <?php
    echo TbHtml::submitButton($model->isNewRecord ? 'Add Room' : 'Save', array(
        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
        'size' => TbHtml::BUTTON_SIZE_LARGE,
    ));
    ?>
</div>
<?php $this->endWidget(); ?>