<?php
/* @var $this BookController */
/* @var $model Book */
$this->pageTitle = 'Reservation - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Books' => array('index'),
    'Create',
);
?>
<h1>Reservation</h1>
<div class="row booking_summary">
    <div class="span12">	
        <div class="row">
            <div class="span9">
                <?php $this->renderPartial('_form', array('model' => $model)); ?>                
            </div>
            <div class="span3">
                <br /><br />
                <h3><span>Your</span> summary</h3>
                <p>
                    Your choosen dates are:
                <div class="pull-left">Arrival : <i><?php echo UserAdmin::get_date($_REQUEST['from']); ?></i></div><br />
                <div class="pull-left">Departure : <i><?php echo UserAdmin::get_date($_REQUEST['to']); ?></i></div><br />
                </p>
            </div>
        </div>
    </div>
</div>