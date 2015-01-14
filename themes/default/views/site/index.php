<?php
$array = Yii::app()->db->createCommand()
        ->select('*')
        ->from('{{banner}}')
        ->where('published=1 AND catid=6')
        ->order('ordering ASC, created_on DESC')
        ->queryAll();
?>
<div class="row-fluid slideshow-row">
    <div class="span12 slideshow">
        <div class="slider-wrapper theme-default">
            <div class="ribbon"></div>
            <div id="nivoslider-125" class="nivoSlider">
                <?php
                foreach ($array as $key => $values) {
                    echo CHtml::image(Yii::app()->baseUrl . '/uploads/banners/' . $values['banner'], $values['name'], array('alt' => $values['name'], 'class' => '', 'title' => $values['name'], 'style' => ''));
                }
                ?> 
            </div>
        </div>
        <div id="nivoslider-125-caption-0" class="nivo-html-caption">You can add captions too&#8230;</div>
    </div>
</div>
<div class="row">	
    <div class="span12">
        <h3><?php echo Content::get_title(1); ?></h3>
        <?php echo Content::get_introtext(1); ?>
    </div>
</div>
<hr />
<div class="row-fluid">
    <div class="span3">
        <h3><span>R</span>esorts</h3>
        <?php
        $location = CHtml::image(Yii::app()->theme->baseUrl . '/css/images/location.jpg', Yii::app()->name, array('alt' => Yii::app()->name, 'class' => 'img-responsive', 'title' => Yii::app()->name, 'style' => ''));
        echo CHtml::link($location, array('resort/index'), array('class' => ''));
        ?>
        <p>We're easily accessible - go anywhere quickly.</p>
    </div>    		
    <div class="span3">
        <h3><?php echo ContentCategory::getCategoryName(3); ?></h3>
        <?php
        $services = CHtml::image(Yii::app()->theme->baseUrl . '/css/images/services.png', Yii::app()->name, array('alt' => Yii::app()->name, 'class' => 'img-responsive', 'title' => Yii::app()->name, 'style' => ''));
        echo CHtml::link($services, array('content/services'), array('class' => ''));
        ?>
        <p><?php echo ContentCategory::getCategoryDetails(3); ?></p>
    </div>		
    <div class="span3">
        <h3><?php echo ContentCategory::getCategoryName(4); ?></h3>
        <?php
        $promotions = CHtml::image(Yii::app()->theme->baseUrl . '/css/images/promotions.png', Yii::app()->name, array('alt' => Yii::app()->name, 'class' => 'img-responsive', 'title' => Yii::app()->name, 'style' => ''));
        echo CHtml::link($promotions, array('content/promotions'), array('class' => ''));
        ?>
        <p><?php echo ContentCategory::getCategoryDetails(4); ?></p>
    </div>
    <div class="span3">
        <h3><?php echo Banner::getCategoryName(1); ?></h3>
        <?php
        $rooms = CHtml::image(Yii::app()->theme->baseUrl . '/css/images/rooms.jpg', Yii::app()->name, array('alt' => Yii::app()->name, 'class' => 'img-responsive', 'title' => Yii::app()->name, 'style' => ''));
        echo CHtml::link($rooms, array('gallery/index'), array('class' => ''));
        ?>
        <p><?php echo BannerCategory::getdetails(1); ?></p>
    </div>
</div>
