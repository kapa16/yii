<?php

namespace app\forms\task;

use app\entities\task\Task;
use app\helpers\TaskHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class TaskSearchForm extends Model
{
    public $id;
    public $name;
    public $status;
    public $responsible;
    public $deadline;

    public function rules(): array
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'responsible'], 'safe'],
            [['deadline'], 'datetime'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Task::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status_id' => $this->status,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

    public function statusList(): array
    {
        return TaskHelper::statusList();
    }
}