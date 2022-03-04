<?php
/** @var SystemDocs $documentation */

/** @var View $this */

use common\models\SystemDocs;
use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\Html;
use yii\web\View;

$this->title = Yii::t('app', "Legal Documentation");
BootstrapAsset::register($this);
$attributes = $documentation->getAttributes(null, ['id']);

?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-12 col-md-3 col-lg-2 col-xl-2 mb-3">
                <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                    <li class="nav-item">
                        <?= Html::img("@web/images/logo.png", [
                            'class' => 'w-100'
                        ]) ?>
                    </li>
                    <?php  foreach ($attributes as $name => $content): ?>
                        <?php
                        $id = Html::getInputId($documentation, $name);
                        ?>
                        <li class="nav-item">
                            <a class="nav-link text-warning" id="<?= $id ?>-tab" data-toggle="tab" href="#<?= $id ?>"
                               role="tab"
                               aria-controls="<?= $id ?>"
                               aria-selected="false"><?= $documentation->getAttributeLabel($name) ?></a>
                        </li>

                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-10 col-xl-10 text-white">
                <div class="tab-content" id="myTabContent">
                    <?php $first = true; foreach ($attributes as $name => $content): ?>
                        <?php
                        $id = Html::getInputId($documentation, $name);
                        ?>
                        <div class="tab-pane fade <?= $first ? 'show active' : '' ?>" id="<?= $id ?>" role="tabpanel" aria-labelledby="<?= $id ?>-tab">
                            <h2 class="text-warning text-center"><?= $documentation->getAttributeLabel($name) ?></h2>
                            <p><?= $content ?></p>
                        </div>
                        <?php
                        $first = false;
                        ?>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
<?php
$js = <<<JS
$(document).on('click', ".nav-link", function(event){
    event.preventDefault();
    // $("#myTabContent").fadeOut('10');
    $(".show").removeClass('show');
    $(".active").removeClass('active');
    
    let target = $(this).attr('aria-controls');
    $("#"+target).addClass('show');
    $("#"+target).addClass('active');
    $("#myTabContent").fadeIn('10');
    return false;
})
JS;
$this->registerJs($js);
?>