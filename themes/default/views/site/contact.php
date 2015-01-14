<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->pageTitle = 'Contact Us - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Contact',
);
?>
<h1>Contact Us</h1>
<?php if (Yii::app()->user->hasFlash('contact')): ?>

    <?php
    $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts' => array('contact'),
    ));
    ?>
<?php else: ?>
    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'book-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'form-horizontal')
    ));
    ?>
    <fieldset>
        <p class="note">Fields with <span class="required">*</span> are required.</p>
        <?php echo $form->errorSummary($model); ?>
        <div class="row">
            <div class="span12">
                <?php echo $form->labelEx($model, 'name'); ?>
                <?php echo $form->textField($model, 'name', array('maxlength' => 150, 'placeholder' => 'Name...', 'class' => 'span8')); ?>
            </div>	
            <div class="span12">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email', array('maxlength' => 150, 'placeholder' => 'Email...', 'class' => 'span8')); ?>
            </div>
            <div class="span12">
                <?php echo $form->labelEx($model, 'subject'); ?>
                <?php echo $form->textField($model, 'subject', array('maxlength' => 150, 'placeholder' => 'Subject...', 'class' => 'span8')); ?>
            </div>
            <div class="span12">
                <?php echo $form->labelEx($model, 'body'); ?>
                <?php echo $form->textArea($model, 'body', array('rows' => 6, 'class' => 'span8')); ?>
            </div>
            <div class="span12">
                <?php if (CCaptcha::checkRequirements()): ?>
                    <div class="row">
                        <?php //echo $form->labelEx($model, 'verifyCode'); ?>
                        <div>
                            <?php $this->widget('CCaptcha'); ?>
                            <?php echo $form->textField($model, 'verifyCode'); ?>
                        </div>
                        <div class="hint">Please enter the letters as they are shown in the image above. Letters are not case-sensitive.</div>
                        <?php echo $form->error($model, 'verifyCode'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="span8">
                <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary btn-large book-now pull-right')); ?>
            </div>
        </div>
    </fieldset>
    <?php $this->endWidget(); ?>
<?php endif; ?>