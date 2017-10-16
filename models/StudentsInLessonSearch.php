<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StudentsInLesson;

/**
 * StudentsInLessonSearch represents the model behind the search form about `app\models\StudentsInLesson`.
 */
class StudentsInLessonSearch extends StudentsInLesson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lesson_id', 'student_id', 'attendance', 'mark_work_at_lesson', 'mark_homework', 'mark_dictation'], 'integer'],
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
        $query = StudentsInLesson::find();

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
            'lesson_id' => $this->lesson_id,
            'student_id' => $this->student_id,
            'attendance' => $this->attendance,
            'mark_work_at_lesson' => $this->mark_work_at_lesson,
            'mark_homework' => $this->mark_homework,
            'mark_dictation' => $this->mark_dictation,
        ]);

        return $dataProvider;
    }
}
