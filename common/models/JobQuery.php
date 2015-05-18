<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Job]].
 *
 * @see Job
 */
class JobQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Job[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Job|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}