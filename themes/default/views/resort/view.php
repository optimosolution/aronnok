<?php
/* @var $this ResortController */
/* @var $model Resort */
?>

<?php
$this->pageTitle = $model->resort . ' - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Resorts' => array('index'),
    $model->resort,
);
?>
<h3><?php echo $model->resort; ?></h3>
<div class="row" style="margin-bottom: 20px;">
    <div class="span12">
        <?php echo Resort::get_images($model->id); ?>       
    </div>	 
</div>
<div class="row">	 
    <div class="span12">        
        <p><span class="text-success"><strong>Location:</strong> <?php echo CHtml::link(Location::getLocation($model->location), array('location/view', 'id' => $model->location), array('target' => '_blank')); ?></span></p>
        <p><?php echo $model->details; ?></p>
        <p><?php echo $model->map; ?></p>
    </div>
</div>
<div class="row">
    <div class="span10"></div>
    <div class="span2">
        <?php echo CHtml::link('Book Now!', array('reservation/index', 'location' => $model->location, 'resort' => $model->id), array('class' => 'btn btn-primary btn-large check-availability')); ?>
    </div>
</div>