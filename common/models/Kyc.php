<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kyc".
 *
 * @property int $id
 * @property string|null $document_picture
 * @property string|null $self_picture
 * @property string|null $self_picture_with_doc
 * @property string|null $status
 * @property int|null $business_profile_id
 *
 * @property BusinessProfile $businessProfile
 */
class Kyc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kyc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_profile_id'], 'default', 'value' => null],
            [['business_profile_id'], 'integer'],
            [['document_picture', 'self_picture', 'self_picture_with_doc', 'status'], 'string', 'max' => 255],
            [['business_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessProfile::className(), 'targetAttribute' => ['business_profile_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'document_picture' => Yii::t('app', 'Document Picture'),
            'self_picture' => Yii::t('app', 'Self Picture'),
            'self_picture_with_doc' => Yii::t('app', 'Self Picture With Doc'),
            'status' => Yii::t('app', 'Status'),
            'business_profile_id' => Yii::t('app', 'Business Profile ID'),
        ];
    }

    /**
     * Gets query for [[BusinessProfileController]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessProfile()
    {
        return $this->hasOne(BusinessProfile::className(), ['id' => 'business_profile_id']);
    }
}
