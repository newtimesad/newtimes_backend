<?php

namespace api\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * PostSearch represents the model behind the search form of `common\models\Post`.
 */
class PostSearch extends Post
{
    public $userId;
    public $stateId;
    public $cityId;
    public $countryId;
    public $serviceId;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'business_profile_id', 'userId', 'cityId', 'stateId', 'countryId', 'serviceId'], 'integer'],
            [['bio', 'status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $loadFilterModel = false)
    {
        $query = Post::find();
        $query->innerJoin('business_profile', 'business_profile_id=business_profile.id');
        $query->innerJoin('city', 'business_profile.city_id=city.id');
        $query->innerJoin('state', 'city.state_id=state.id');
        $query->innerJoin('post_service', 'post_service.post_id=post.id');

        $loadFilterModel ? $this->load($params, 'filter') : $this->load($params);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'business_profile_id' => $this->business_profile_id,
        ]);

        $query->andFilterWhere(['like', 'bio', $this->bio])
            ->andFilterWhere(['like', 'status', $this->status]);

        if (isset($this->userId)) {
            $query->andFilterWhere(['business_profile.user_id' => $this->userId]);
        }

        if (isset($this->cityId)) {
            $query->andFilterWhere(['business_profile.city_id' => $this->cityId]);
        }

        if(isset($this->stateId)){
            $query->andFilterWhere(['state.id' => $this->stateId]);
        }

        if(isset($this->countryId)){
            $query->andFilterWhere(['state.country_id' => $this->countryId]);
        }

        if(isset($this->serviceId)){
            $query->andFilterWhere(['post_service.service_id' => $this->serviceId]);
        }



        return $dataProvider;
    }
}
