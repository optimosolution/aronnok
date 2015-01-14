<?php
/* @var $this GalleryController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'The gallery - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Picture Gallery',
);
$array = Yii::app()->db->createCommand()
        ->select('*')
        ->from('{{banner}}')
        ->where('published=1 AND catid=1 OR catid IN(SELECT c.id FROM {{banner_category}} c WHERE c.parent_id=1)')
        ->order('ordering ASC, created_on DESC')
        ->queryAll();
$array_category = Yii::app()->db->createCommand()
        ->select('*')
        ->from('{{banner_category}}')
        ->where('published=1 AND parent_id=1')
        ->queryAll();
Yii::app()->clientScript->registerScript('fancybox', "
    $(document).ready(function() {
	$('.fancybox-button').fancybox({
		prevEffect		: 'none',
		nextEffect		: 'none',
		closeBtn		: false,
		helpers		: {
			title	: { type : 'inside' },
			buttons	: {}
		}
	});
    });
");
?>
<div class="row">
    <div class="span12">	
        <h1>The gallery</h1><br />
    </div>	
    <div class="span12">
        <div class="row">
            <div class="span12">
                <ul class="nav nav-pills gallery-pills" id="gallery_links">
                    <li><a href="#all" data-id="all">All</a></li>
                    <?php
                    foreach ($array_category as $key => $values) {
                        echo'<li><a href="#' . $values['id'] . '" data-id="' . $values['id'] . '">' . $values['title'] . '</a></li>';
                    }
                    ?> 
                </ul>	
            </div>
        </div>
    </div>
    <div class="span12">	
        <ul class="thumbnails" id="gallery">
            <?php
            foreach ($array as $key => $values) {
                echo '<li class="span4 aa-' . $values['catid'] . '" data-id="' . $values['catid'] . '-' . $values['id'] . '" data-type="' . $values['catid'] . '">';
                $location = CHtml::image(Yii::app()->baseUrl . '/uploads/banners/' . $values['banner'], $values['name'], array('alt' => $values['name'], 'class' => '', 'title' => $values['name'], 'style' => ''));
                echo CHtml::link($location, Yii::app()->baseUrl . '/uploads/banners/' . $values['banner'], array('class' => 'thumbnail fancybox-button', 'rel' => $values['catid'], 'title' => $values['name']));
                echo '</a>';
                echo '</li>';
            }
            ?>            
        </ul>
    </div>
</div>