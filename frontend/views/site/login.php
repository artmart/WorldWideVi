<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
<?php /*
    <h1 class="text-center mt-2 text-primary"><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>
*/ ?>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?php // $form->field($model, 'rememberMe')->checkbox() ?>
<?php /*
                <div class="my-1 mx-0" style="color:#999;">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                    <br>
                    Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                </div>
*/ ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>