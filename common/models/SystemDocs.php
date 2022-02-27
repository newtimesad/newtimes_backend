<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "system_docs".
 *
 * @property int $id
 * @property string|null $privacy
 * @property string|null $terms_conditions
 * @property string|null $advertiser_agreement
 * @property string|null $about
 * @property string|null $exemption
 * @property string|null $dmca_photo_complaints
 * @property string|null $trademarks
 * @property string|null $reporting_trafficking
 * @property string|null $law_enforcement
 * @property string|null $verified
 */
class SystemDocs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_docs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['privacy', 'terms_conditions', 'advertiser_agreement', 'about', 'exemption', 'dmca_photo_complaints', 'trademarks', 'reporting_trafficking', 'law_enforcement', 'verified'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'privacy' => Yii::t('app', 'Privacy'),
            'terms_conditions' => Yii::t('app', 'Terms Conditions'),
            'advertiser_agreement' => Yii::t('app', 'Advertiser Agreement'),
            'about' => Yii::t('app', 'About'),
            'exemption' => Yii::t('app', 'Exemption'),
            'dmca_photo_complaints' => Yii::t('app', 'Dmca Photo Complaints'),
            'trademarks' => Yii::t('app', 'Trademarks'),
            'reporting_trafficking' => Yii::t('app', 'Reporting Trafficking'),
            'law_enforcement' => Yii::t('app', 'Law Enforcement'),
            'verified' => Yii::t('app', 'Verified'),
        ];
    }
}
