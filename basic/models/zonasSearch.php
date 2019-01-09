<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\zonas;

/**
 * zonasSearch represents the model behind the search form of `app\models\zonas`.
 */
class zonasSearch extends zonas
{
    public $claseZona;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zona_id'], 'integer'],
            [['claseZona', 'nombre'], 'safe'],
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
        $query = zonas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

         $dataProvider->setSort([
            'attributes' => [
                'id',
                
                'nombre',
                'claseZona' => [
                    'asc' => ['clase_zona_id' => SORT_ASC],
                    'desc' => ['clase_zona_id' => SORT_DESC],
                    'default' => SORT_ASC
                ],
                'zona_id'
            ]
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
            'zona_id' => $this->zona_id,
            'zonas.clase_zona_id' => $this->claseZona,
        ]);

        $query->andFilterWhere(['like', 'clase_zona_id', $this->clase_zona_id])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
