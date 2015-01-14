<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

                    <?php echo $form->textFieldControlGroup($model,'id',array('span'=>5)); ?>

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
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->