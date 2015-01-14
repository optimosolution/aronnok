<?php
$this->pageTitle = 'Change Password - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Change Password',
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
            'id' => 'user-changepassword-form',
            'enableClientValidation' => true,
            'htmlOptions' => array('id' => 'user-recovery-form', 'class' => 'smart-form client-form'),
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>
        <?php echo $forms->errorSummary($form2, 'Please fix the following input errors:', '', array('class' => 'text-danger', 'style' => 'padding-left:10px;')); ?>
        <div class="row">
            <div class="span-12">
                <h3>Change Password</h3>
            </div>
        </div>
        <div class="row">
            <div class="span-12">
                <?php echo $forms->passwordField($form2, 'password', array('maxlength' => 100, 'placeholder' => 'Password')); ?>
            </div>
        </div>
        <div class="row">
            <div class="span-12">
                <?php echo $forms->passwordField($form2, 'verifyPassword', array('maxlength' => 100, 'placeholder' => 'Verify Password')); ?>
            </div>
        </div>       
        <div class="row" style="margin-top: 20px;">
            <div class="span-12">
                <?php echo CHtml::submitButton('Change Password', array('class' => 'btn btn-primary btn-large check-availability')); ?> 
            </div>
        </div>
        <?php $this->endWidget(); ?>           
    </div>
</div>