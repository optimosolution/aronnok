<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span12">
        <?php if (isset($this->breadcrumbs)): ?>
            <?php
            $this->widget('bootstrap.widgets.TbBreadcrumb', array(
                'links' => $this->breadcrumbs,
            ));
            ?><!-- breadcrumbs -->
        <?php endif ?>
        <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'block' => true,
            'fade' => true,
            'closeText' => '&times;',
        ));
        ?>
    </div>
</div>
<div class="row">
    <div class="span12">
        <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>
