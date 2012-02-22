<div class="main-content">
    <div class="section">
        <div class="sub-section">
            <div class="module rounded-corners-bottom-10px tab-<?php echo $this->id; ?>">
                <?php $this->renderPartial('//common/pageblock/modulesMainMenu', array('punkts' => $this->punkts)); ?>
                <div class="module-content sub-section clearfix">
                    <?php
                    echo $content;
                    ?>
                </div>
            </div>
        </div>  
    </div>
</div>
