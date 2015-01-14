<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'book-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal')
        ));
?>
<?php echo $form->hiddenField($model, 'arrival', array('value' => $_REQUEST['from'])); ?>
<?php echo $form->hiddenField($model, 'departure', array('value' => $_REQUEST['to'])); ?>
<fieldset>
    <h1><small>Fill out the form to complete your reservation.</small></h1><br />
    <p><?php echo $form->errorSummary($model); ?></p>
    <div class="row">
        <div class="span8">
            <legend><span>Your</span> name</legend>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->dropDownList($model, 'title', array('Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Miss.' => 'Miss.'), array('empty' => '--please select--', 'class' => '')); ?>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model, 'first_name'); ?>
            <?php echo $form->textField($model, 'first_name', array('maxlength' => 150, 'placeholder' => 'First Name...')); ?>
        </div>	
        <div class="span3">
            <?php echo $form->labelEx($model, 'last_name'); ?>
            <?php echo $form->textField($model, 'last_name', array('maxlength' => 150, 'placeholder' => 'Last Name...')); ?>
        </div>
    </div>		
    <br />
    <div class="row">
        <div class="span8">
            <legend><span>Your</span> contact details</legend>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email', array('maxlength' => 150, 'placeholder' => 'Email Address')); ?>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model, 'mobile'); ?>
            <?php echo $form->textField($model, 'mobile', array('maxlength' => 100, 'placeholder' => 'Mobile')); ?>
        </div>	
        <div class="span3">
            <?php echo $form->labelEx($model, 'phone'); ?>
            <?php echo $form->textField($model, 'phone', array('maxlength' => 100, 'placeholder' => 'Phone')); ?>            
        </div>
    </div>
    <br />
    <div class="row">
        <div class="span8">            
            <legend><span>Your</span> address</legend>
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model, 'address'); ?>
            <?php echo $form->textArea($model, 'address', array('rows' => 3, 'class' => 'address_box')); ?>
        </div>				
        <div class="span3">
            <?php echo $form->labelEx($model, 'city'); ?>
            <?php echo $form->textField($model, 'city', array('maxlength' => 150, 'placeholder' => 'City')); ?>
            <?php echo $form->labelEx($model, 'zip'); ?>
            <?php echo $form->textField($model, 'zip', array('maxlength' => 11, 'placeholder' => 'ZIP/Postal')); ?> 
        </div>
        <div class="span3">
            <?php echo $form->labelEx($model, 'state'); ?>
            <?php echo $form->textField($model, 'state', array('maxlength' => 150, 'placeholder' => 'State/Province')); ?>
            <?php echo $form->labelEx($model, 'country'); ?>
            <?php echo $form->dropDownList($model, 'country', CHtml::listData(Country::model()->findAll(array('condition' => 'published=1', "order" => "country_name")), 'id', 'country_name'), array('empty' => '--please select--', 'class' => '')); ?>
        </div>
    </div>		
    <br />
    <div class="row">
        <div class="span9">
            <legend><span>Any</span> special requests?</legend>
            <?php echo $form->textArea($model, 'special_requests', array('rows' => 3, 'class' => 'span9')); ?>
        </div>			
    </div>
    <br />
    <div class="row">
        <div class="span9">
            <?php echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large book-now pull-right')); ?>
        </div>
    </div>
</fieldset>
<?php $this->endWidget(); ?>