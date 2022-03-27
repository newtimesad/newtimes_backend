<?php

use common\models\BusinessProfile;
use common\models\City;
use common\models\Kyc;
use common\models\Location;
use common\models\PostType;
use common\models\Service;
use common\models\SpecialityCategory;
use kartik\editors\Codemirror;
use kartik\editors\Summernote;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="card bg-dark">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <?= $form->field($model, 'title')->textInput(['placeholder' => Yii::t('app', "Say hello...")]) ?>
                    <?= $form->field($model, 'visiting')->textInput(['placeholder' => Yii::t('app', "Visiting until...")]) ?>
                    <?= $form->field($model, '_locations')->widget(Select2::class, [
                        'data' => ArrayHelper::map($model->locations, 'id', 'name'),
                        'options' => [
                            'multiple' => true,
                            'prompt' => "Select locations"
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'minimumInputLength' => 3,
                            'language' => [
                                'errorLoading' => new JsExpression("function () { return '" . Yii::t('app', 'Waiting for results ...') . "'; }"),
                            ],
                            'ajax' => [
                                'url' => Url::to(['city/get-cities-ajax']),
                                'dataType' => 'json',
                                'data' => new JsExpression('function(params) { return {q:params.term}; }'),
                                'cache' => true
                            ],
                            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                            'templateResult' => new JsExpression('function(item) { return item.text; }'),
//            'templateSelection' => new JsExpression('function (item) { console.log(item.text);item.text }'),
                        ]
                    ]) ?>
                    <?= $form->field($model, '_services')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Service::find()->all(), 'id', 'label'),
                        'options' => [
                            'multiple' => true,
                            'prompt' => "Select services"
                        ]
                    ]) ?>
                    <?= $form->field($model, '_specialityCategories')->widget(Select2::class, [
                        'data' => ArrayHelper::map(SpecialityCategory::find()->all(), 'id', 'label'),
                        'options' => [
                            'multiple' => true,
                            'prompt' => "Select specialities"
                        ]
                    ]) ?>
                    <?= $form->field($model, 'type_id')->dropDownList(
                            ArrayHelper::map(PostType::find()->all(), 'id', 'label')
                    ) ?>
                    <?= $form->field($model, 'business_profile_id')->dropDownList(
                            ArrayHelper::map(
                                    BusinessProfile::find()
                                        ->innerJoinWith(['kyc' => function(ActiveQuery $q){
                                            $q->andWhere(['status' => Kyc::KYC_STATUS_ACCEPTED]);
                                        }])
                                        ->where(['user_id' => Yii::$app->user->identity->id])
                                        ->all(), 'id', 'name')
                    ) ?>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                    <?= $form->field($model, 'bio')->widget(Summernote::class, [
                            'useKrajeePresets' => false,
                        'pluginOptions' => [
                            'height' => 300,
                            'dialogsFade' => true,
                            'toolbar' => [
                                ['style1', ['style']],
                                ['style2', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript']],
                                ['font', ['fontname', 'fontsize', 'clear']],
                                ['para', ['ul', 'ol', 'paragraph', 'height']],
                                ['insert', ['link', 'hr']],
                            ],
                            'fontSizes' => ['8', '9', '10', '11', '12', '13', '14', '16', '18', '20', '24', '36', '48'],
                            'codemirror' => [
                                'theme' => Codemirror::DEFAULT_THEME,
                                'lineNumbers' => true,
                                'styleActiveLine' => true,
                                'matchBrackets' => true,
                                'smartIndent' => true,
                            ],
                        ]
                    ]) ?>
                </div>
            </div>


        </div>
        <div class="card-footer">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-sm btn-success', 'style'=>"background-color: orange; border-color: orange;"]) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<JS
$(function(){
    $("#post-bio-container").removeClass('form-control');
});
JS;
$this->registerJs($js);
?>
