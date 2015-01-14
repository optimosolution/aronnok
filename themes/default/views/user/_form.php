<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
<h4>Personal Details</h4>
<div class="row">
    <div class="span6">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255, 'class' => 'span5')); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="span6">
        <?php if ($model->isNewRecord) { ?>
            <?php echo $form->labelEx($model, 'username'); ?>
            <?php echo $form->textField($model, 'username', array('size' => 60, 'maxlength' => 150, 'class' => 'span5')); ?>
            <?php echo $form->error($model, 'username'); ?>
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="span6">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 100, 'class' => 'span5')); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="span6">
        <?php if ($model->isNewRecord) { ?>
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 100, 'class' => 'span5')); ?>
            <?php echo $form->error($model, 'password'); ?>
        <?php } ?>
    </div>
</div>
<h4>Contact Details</h4>
<div class="row">
    <div class="span6">
        <?php echo $form->labelEx($model_profile, 'country_id'); ?>
        <?php echo $form->dropDownList($model_profile, 'country_id', CHtml::listData(Country::model()->findAll(array('condition' => 'published=1', "order" => "country_name")), 'id', 'country_name'), array('empty' => '--please select--', 'class' => 'span5', 'options' => array('18' => array('selected' => true)))); ?>
    </div>
    <div class="span6">
        <?php echo $form->labelEx($model_profile, 'state_id'); ?>
        <?php echo $form->dropDownList($model_profile, 'state_id', CHtml::listData(State::model()->findAll(array('condition' => 'published=1', "order" => "state_name")), 'id', 'state_name'), array('empty' => '--please select--', 'class' => 'span5', 'options' => array())); ?>
    </div>
</div>
<div class="row">
    <div class="span6">
        <?php echo $form->labelEx($model_profile, 'city_id'); ?>
        <?php echo $form->dropDownList($model_profile, 'city_id', CHtml::listData(City::model()->findAll(array('condition' => 'published=1', "order" => "city_name")), 'id', 'city_name'), array('empty' => '--please select--', 'class' => 'span5', 'options' => array())); ?>
    </div>
    <div class="span6">
        <?php echo $form->labelEx($model_profile, 'address'); ?>
        <?php echo $form->textField($model_profile, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>
    </div>
</div>
<div class="row">
    <div class="span6">
        <?php echo $form->labelEx($model_profile, 'mobile'); ?>
        <?php echo $form->textField($model_profile, 'mobile', array('class' => 'span5', 'maxlength' => 100)); ?>
    </div>
    <div class="span6">
        <?php echo $form->labelEx($model_profile, 'phone'); ?>
        <?php echo $form->textField($model_profile, 'phone', array('class' => 'span5', 'maxlength' => 100)); ?>
    </div>
</div>
<div class="row">
    <div class="span6">
        <?php echo $form->labelEx($model_profile, 'fax'); ?>
        <?php echo $form->textField($model_profile, 'fax', array('class' => 'span5', 'maxlength' => 100)); ?>
    </div>
    <div class="span6">
        <?php echo $form->labelEx($model_profile, 'website'); ?>
        <?php echo $form->textField($model_profile, 'website', array('class' => 'span5', 'maxlength' => 150)); ?>
    </div>
</div>
<div class="row">
    <div class="span6">
        <?php echo $form->labelEx($model_profile, 'profile_picture'); ?>
        <?php echo $form->fileField($model_profile, 'profile_picture', array('maxlength' => 255, 'class' => '')); ?>
    </div>
    <div class="span6"></div>
</div>
<div class="row buttons" style="margin-top: 20px;">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Register' : 'Save', array('class' => 'btn btn-primary btn-large check-availability')); ?> 
</div>

<?php $this->endWidget(); ?>