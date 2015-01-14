<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = 'Login - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Login',
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
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'reservation-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => ''),
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>
        <div class="row">
            <div class="span-12">
                <h3>Sign In</h3>
            </div>
        </div>
        <div class="row">
            <div class="span-12">
                <?php echo $form->textField($model, 'username', array('class' => '', 'placeholder' => 'Username')); ?>
            </div>
        </div>
        <div class="row">
            <div class="span-12">
                <?php echo $form->passwordField($model, 'password', array('class' => '', 'placeholder' => 'Password')); ?>
            </div>
        </div>
        <div class="row">
            <div class="span-12">
                <?php echo CHtml::link('Forgot password?', array('recovery/recovery'), array('class' => '')); ?>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="span-12">
                <?php echo $form->checkbox($model, 'rememberMe'); ?> Remember me next time
            </div>
        </div>        
        <div class="row" style="margin-top: 20px;">
            <div class="span-12">
                <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary btn-large check-availability')); ?> 
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>