<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form TbActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'book-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'title',array('span'=>5,'maxlength'=>20)); ?>

            <?php echo $form->textFieldControlGroup($model,'first_name',array('span'=>5,'maxlength'=>150)); ?>

            <?php echo $form->textFieldControlGroup($model,'last_name',array('span'=>5,'maxlength'=>150)); ?>

            <?php echo $form->textFieldControlGroup($model,'email',array('span'=>5,'maxlength'=>150)); ?>

            <?php echo $form->textFieldControlGroup($model,'mobile',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->textFieldControlGroup($model,'phone',array('span'=>5,'maxlength'=>100)); ?>

            <?php echo $form->textFieldControlGroup($model,'address',array('span'=>5,'maxlength'=>250)); ?>

            <?php echo $form->textFieldControlGroup($model,'city',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'state',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'zip',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'country',array('span'=>5)); ?>

            <?php echo $form->textAreaControlGroup($model,'special_requests',array('rows'=>6,'span'=>8)); ?>

            <?php echo $form->textFieldControlGroup($model,'arrival',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'departure',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'location',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'rooms',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'adults_per_room',array('span'=>5)); ?>

            <?php echo $form->textFieldControlGroup($model,'kids_per_room',array('span'=>5)); ?>

        <div class="form-actions">
        <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array(
		    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		    'size'=>TbHtml::BUTTON_SIZE_LARGE,
		)); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->