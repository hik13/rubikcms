<div class="authorization-header">
    <div class="autorization-section">
        <a class="logo" href="#"></a>
    </div>
</div>
    
<div class="login-block">
        <div class="autorization-section">
        
        <div class="login-top rounded-corners-top-10px">          
            <div class="login-title"><?php echo Translater::getDictionary()->avtorisationCreditioanal ?></div>                          
        </div>
            
        <form name="form_login" id="form_login" action="/login" method="POST">		
            <div class="login-content clearfix rounded-corners-bottom-10px">
                <?php if ($error) { ?>
                    <div class="error-system-message">
                        <div class="title">
                            <?php echo Translater::getDictionary()->systemMessage ?>
                        </div>
                        <?php echo $error; ?>				
                    </div>
                <?php } ?>
                    
                <div class="login-content-row clearfix">
                    <?php echo CHtml::activeLabel($model, 'user_login'); ?>
                    <div class="input-border">
                        <?php echo CHtml::activetextField($model, 'user_login', array('size' => 16, 'maxlength' => 16, 'class' => "login_input",)); ?>
                    </div>
                </div>
                    
                <div class="login-content-row">
                    <?php echo CHtml::activeLabel($model, 'user_password'); ?>
                    <div class="input-border">
                        <?php echo CHtml::activePasswordField($model, 'user_password', array('size' => 16, 'maxlength' => 16, 'value' => '', 'class' => "login_input")); ?>
                    </div>
                </div>
                    
                <div class="login-content-row checkbox clearfix">
                    <?php echo CHtml::CheckBox('Admin[rememberMe]', $model->rememberMe, array('class' => "login_input")); ?>
                    <?php echo CHtml::activeLabel($model, 'rememberMe'); ?>
                </div>
                    
                <div class="login-content-row clearfix">
                    <a id="ok_login" onclick="$('#form_login').submit()" class="login-button clearfix" href="#">
                        <div class="login-button-left"></div>
                        <div class="login-button-title"><?php echo Translater::getDictionary()->avtorisationEnter ?></div>
                        <div class="login-button-right"></div></a>
                </div>
                    
            </div>
        </form>
            
    </div>
</div>










