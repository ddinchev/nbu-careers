<?php

namespace frontend\models;

use common\models\JobCategory;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Job;

/**
 * JobSearch represents the model behind the search form about `common\models\Job`.
 */
class JobSearch extends Job
{
    public $score;

    public $keywords;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_category_id', 'job_type', 'employment_type'], 'integer'],
            ['job_category_id', 'exist', 'targetClass' => JobCategory::className(), 'targetAttribute' => 'id'],
            ['employment_type', 'in', 'range' => array_keys(self::$employmentType)],
            ['job_type', 'in', 'range' => array_keys(self::$jobType)],
            [['keywords'], 'safe'],
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
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = JobSearch::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'job_category_id' => $this->job_category_id,
            'job_type' => $this->job_type,
            'employment_type' => $this->employment_type,
        ]);

        if ($this->keywords) {
            $query->andWhere('MATCH (title, description) AGAINST (:keywords)');
            $query->addSelect(['*', 'MATCH (title, description) AGAINST (:keywords) AS score']);
            $query->addParams([':keywords' => $this->keywords]);
        }

        return $dataProvider;
    }
}
