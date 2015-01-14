<?php
$this->pageTitle = 'Forgot password - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Forgot password',
);
?>
<div class="row">
    <div class="span6">
        <h3>New Customer</h3>
        <h4>Register Account</h4>
        <p>By creating an account you will be able to reservation faster, be up to date on an booking's status, and keep track of the reservation you have previously made.</p>
        <?php echo CHtml::link('Register!', array('user/create'), array('class' => 'btn btn-primary btn-large check-availability')); ?>
    </div>
    <div class="span6">
        <?php
        $forms = $this->beginWidget('CActiveForm', array(
            'id' => 'user-recovery-form',
            'enableClientValidation' => true,
            'htmlOptions' => array('id' => 'user-recovery-form', 'class' => 'smart-form client-form'),
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>
        <?php echo $forms->errorSummary($form, 'Please fix the following input errors:', '', array('class' => 'text-danger', 'style' => 'padding-left:10px;')); ?>
        <div class="row">
            <div class="span-12">
                <h3>Forgot password</h3>
            </div>
        </div>
        <div class="row">
            <div class="span-12">                
                <?php echo $forms->textField($form, 'login_or_email', array('class' => '', 'placeholder' => 'Username/E-mail')); ?>
            </div>
        </div>
        <div class="row">
            <div class="span-12">
                <?php echo CHtml::link('I remembered my password!', array('site/login'), array('class' => '')); ?>
            </div>
        </div>       
        <div class="row" style="margin-top: 20px;">
            <div class="span-12">
                <?php echo CHtml::submitButton('Reset Password', array('class' => 'btn btn-primary btn-large check-availability')); ?> 
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>