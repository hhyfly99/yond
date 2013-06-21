<?php echo CHtml::form(); ?>
    <div id="langdrop">
        <?php echo CHtml::dropDownList('_lang', $currentLang, array(
            'zh_cn' => '中文', 'en_us' => 'English'), array('submit' => '')); ?>
    </div>
<?php echo CHtml::endForm(); ?>