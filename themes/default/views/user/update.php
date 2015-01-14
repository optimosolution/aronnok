<?php
/* @var $this UserController */
/* @var $model User */
$this->pageTitle = 'Registration - ' . Yii::app()->name;
$this->breadcrumbs = array(
    $model->name,
    ' / Update',
);
?>
<h1><?php echo $model->name; ?></h1>
<?php $this->renderPartial('_form', array('model' => $model, 'model_profile' => $model_profile,)); ?>