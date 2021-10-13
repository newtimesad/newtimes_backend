<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "business_profile".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $name
 * @property string|null $gender
 * @property int|null $age
 * @property string|null $ethnicity
 * @property string|null $hair_color
 * @property string|null $eye_color
 * @property float|null $height
 * @property string|null $measurements
 * @property string|null $affiliation
 * @property string|null $available_to
 * @property string|null $aviability
 * @property int|null $city_id
 *
 * @property City $city
 * @property User $user
 * @property Email[] $emails
 * @property Kyc[] $kycs
 * @property Phone[] $phones
 * @property Post[] $posts
 * @property SocialNetwork[] $socialNetworks
 */
class BusinessProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'age', 'city_id'], 'default', 'value' => null],
            [['user_id', 'age', 'city_id'], 'integer'],
            [['height'], 'number'],
            [['name', 'ethnicity', 'hair_color', 'eye_color', 'measurements', 'affiliation', 'available_to', 'aviability'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 1],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'gender' => Yii::t('app', 'Gender'),
            'age' => Yii::t('app', 'Age'),
            'ethnicity' => Yii::t('app', 'Ethnicity'),
            'hair_color' => Yii::t('app', 'Hair Color'),
            'eye_color' => Yii::t('app', 'Eye Color'),
            'height' => Yii::t('app', 'Height'),
            'measurements' => Yii::t('app', 'Measurements'),
            'affiliation' => Yii::t('app', 'Affiliation'),
            'available_to' => Yii::t('app', 'Available To'),
            'aviability' => Yii::t('app', 'Aviability'),
            'city_id' => Yii::t('app', 'City ID'),
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Emails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmails()
    {
        return $this->hasMany(Email::className(), ['business_profile_id' => 'id']);
    }

    /**
     * Gets query for [[Kycs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKycs()
    {
        return $this->hasMany(Kyc::className(), ['business_profile_id' => 'id']);
    }

    /**
     * Gets query for [[Phones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(Phone::className(), ['business_profile_id' => 'id']);
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['business_profile_id' => 'id']);
    }

    /**
     * Gets query for [[SocialNetworks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocialNetworks()
    {
        return $this->hasMany(SocialNetwork::className(), ['business_profile_id' => 'id']);
    }
}
