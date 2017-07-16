<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="container">    


    <div id="loginbox" style="margin-top:50px;" class="container">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
<!--                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>-->
            </div>     
            <div style="padding-top:30px" class="panel-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                ]);
                ?>

                <div style="margin-bottom: 25px" class="input-group">
                    <?= $form->field($model, 'username', 
                            ['template' => '<div class="col-sm-12">{label}</div>
                                            <div class="col-sm-12">
                                                <div class="input-group col-lg-12 ">
                                                   <span class="input-group-addon">
                                                      <span class="glyphicon glyphicon-user"></span>
                                                   </span>
                                                   {input}
                                                </div>
                                                {error}{hint}
                                            </div>'
                            ])->textInput(['autofocus' => true,'placeholder' => 'Username'])->label(false); ?>
                </div>
                
                <div style="margin-bottom: 25px" class="input-group">
                    <?= $form->field($model, 'password', 
                            ['template' => '<div class="col-sm-12">{label}</div>
                                            <div class="col-sm-12">
                                                <div class="input-group col-lg-12 ">
                                                   <span class="input-group-addon">
                                                      <span class="glyphicon glyphicon-lock"></span>
                                                   </span>
                                                   {input}
                                                </div>
                                                {error}{hint}
                                            </div>'
                            ])->passwordInput(['placeholder' => 'password'])->label(false); ?>
                </div>
                    <div class="checkbox">
                            <?=
                            $form->field($model, 'rememberMe')->checkbox()
                            ?>
                        
                            
                    </div>
                <div style="margin-top:10px" class="form-group">
                    <!-- Button -->

                    <div class="col-lg-12">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                         <?= Html::a('Tentang Kami',['site/about'],['class' => 'btn btn-info', 'name' => 'about-button']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                           
                        </div>
                    </div>
                </div>    
            </div>                     
        </div>  
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
