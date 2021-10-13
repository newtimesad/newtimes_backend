<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $bio
 * @property string|null $status
 * @property int|null $type_id
 * @property int|null $business_profile_id
 *
 * @property Payment[] $payments
 * @property BusinessProfile $businessProfile
 * @property PostType $type
 * @property PostLocation[] $postLocations
 * @property PostService[] $postServices
 * @property SpecialityCategoryPost[] $specialityCategoriesPosts
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bio'], 'string'],
            [['type_id', 'business_profile_id'], 'default', 'value' => null],
            [['type_id', 'business_profile_id'], 'integer'],
            [['status'], 'string', 'max' => 255],
            [['business_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessProfile::className(), 'targetAttribute' => ['business_profile_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bio' => Yii::t('app', 'Bio'),
            'status' => Yii::t('app', 'Status'),
            'type_id' => Yii::t('app', 'Type ID'),
            'business_profile_id' => Yii::t('app', 'Business Profile ID'),
        ];
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['post_id' => 'id']);
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

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(PostType::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[PostLocations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostLocations()
    {
        return $this->hasMany(PostLocation::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[PostServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostServices()
    {
        return $this->hasMany(PostService::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[SpecialityCategoriesPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialityCategoriesPosts()
    {
        return $this->hasMany(SpecialityCategoriesPost::className(), ['post_id' => 'id']);
    }
}
