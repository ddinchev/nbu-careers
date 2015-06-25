<?php

namespace backend\models\search;

use common\models\Job;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * JobSearch represents the model behind the search form about `common\models\Job`.
 */
class JobSearch extends Job
{
    /**
     * Used for related search of companyName
     * @var string
     */
    public $company_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'job_category_id', 'job_type', 'employment_type', 'status'], 'integer'],
            [['title', 'ref_no', 'description', 'company_name', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Job::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);;

        // related sorting
        $dataProvider->getSort()->attributes['company_name'] = [
            'asc' => ['company.name' => SORT_ASC],
            'desc' => ['company.name' => SORT_DESC],
            'label' => Yii::t('backend', 'Company Name'),
            'default' => SORT_ASC
        ];

        $this->load($params);

        $query->andFilterWhere([
            'id' => $this->id,
            'company_id' => $this->company_id,
            'job_category_id' => $this->job_category_id,
            'job_type' => $this->job_type,
            'employment_type' => $this->employment_type,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'ref_no', $this->ref_no])
            ->andFilterWhere(['like', 'description', $this->description]);

        // related search
        $query->joinWith([
            'company' => function (ActiveQuery $q) {
                $q->andFilterWhere(['like', 'company.name', $this->company_name]);
            }
        ]);

        return $dataProvider;
    }
}
