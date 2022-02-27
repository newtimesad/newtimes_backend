<?php
/** @var \common\models\SystemDocs $documentation */

/** @var \yii\web\View $this */

use kartik\editors\Codemirror;

$this->title = Yii::t('app', "System Documentation");

$editorConfig = [
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
];
?>
<?php
$form = \yii\bootstrap4\ActiveForm::begin([
    'enableAjaxValidation' => true,
    'enableClientValidation' => true
]);
?>
    <div class="card bg-dark">
        <div class="card-header">
            <?= \yii\bootstrap4\Html::submitButton(Yii::t('app', "Save"), [
                    'class' => 'btn btn-sm btn-success'
            ]) ?>
        </div>
        <div class="card-body">

            <div class="border p-2">
                <?= $form->field($documentation, 'privacy')->widget(\kartik\editors\Summernote::class, $editorConfig) ?>
            </div>
            <div class="border mt-2 p-2">
                <?= $form->field($documentation, 'terms_conditions')->widget(\kartik\editors\Summernote::class, $editorConfig) ?>
            </div>

            <div class="border mt-2 p-2">
                <?= $form->field($documentation, 'advertiser_agreement')->widget(\kartik\editors\Summernote::class, $editorConfig) ?>
            </div>

            <div class="border mt-2 p-2">
                <?= $form->field($documentation, 'about')->widget(\kartik\editors\Summernote::class, $editorConfig) ?>
            </div>

            <div class="border mt-2 p-2">
                <?= $form->field($documentation, 'exemption')->widget(\kartik\editors\Summernote::class, $editorConfig) ?>
            </div>

            <div class="border mt-2 p-2">
                <?= $form->field($documentation, 'dmca_photo_complaints')->widget(\kartik\editors\Summernote::class, $editorConfig) ?>
            </div>

            <div class="border mt-2 p-2">
                <?= $form->field($documentation, 'trademarks')->widget(\kartik\editors\Summernote::class, $editorConfig) ?>
            </div>

            <div class="border mt-2 p-2">
                <?= $form->field($documentation, 'reporting_trafficking')->widget(\kartik\editors\Summernote::class, $editorConfig) ?>
            </div>

            <div class="border mt-2 p-2">
                <?= $form->field($documentation, 'law_enforcement')->widget(\kartik\editors\Summernote::class, $editorConfig) ?>
            </div>

        </div>
    </div>
<?php
\yii\bootstrap4\ActiveForm::end()
?>
<?php
$js = <<<JS
$(function(){
    $("div[id*=-container]").removeClass('form-control');
});
JS;
$this->registerJs($js);
?>