<?php
/* @var $this LocationController */
/* @var $model Location */
/* @var $form TbActiveForm */
?>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'location-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
Yii::app()->clientScript->registerScript('search', "
    $('#Location_picture').ace_file_input({
        no_file: 'No Image ...',
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

<?php echo $form->textFieldControlGroup($model, 'location', array('span' => 5, 'maxlength' => 250)); ?>
<div class="control-group">
    <label for="form-field-1" class="control-label"><?php echo $form->labelEx($model, 'details'); ?></label>
    <div class="controls">
        <?php
        $this->widget('application.extensions.yii-ckeditor.CKEditorWidget', array(
            'model' => $model,
            'attribute' => 'details',
            // editor options http://docs.ckeditor.com/#!/api/CKEDITOR.config
            'config' => array(
                'language' => 'en',
            //'toolbar' => 'Basic',
            ),
        ));
        ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span5">
        <?php echo $form->fileFieldControlGroup($model, 'picture', array('size' => 36, 'maxlength' => 255, 'class' => 'span5')); ?>
    </div>
</div>
<?php echo $form->textAreaControlGroup($model, 'map', array('rows' => 3, 'span' => 8)); ?>
<div class="form-actions">
    <?php
    echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array(
        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
        'size' => TbHtml::BUTTON_SIZE_LARGE,
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
