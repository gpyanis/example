<?php
namespace app\models;
use yii\data\ActiveDataProvider;
use Yii;
class Registrs extends \yii\db\ActiveRecord
{
    public static function tableName(){
        return 'registrs';
    }

    public static function getDb(){
        return Yii::$app->get('register');
    }
    public function search($params, $type){
      if($type==1){
          $query = Registrs::find()->where(['col' => '3']);
      }
      else {
          $query = Registrs::find()->where(['col' => '1', 'col2'=>'2']);
          $query->andWhere(['is', 'id2', new \yii\db\Expression('null')]);
      }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort'=> ['defaultOrder' => ['ID'=>SORT_DESC]],
        ]);


        if (!($this->load($params) && $this->validate())) {

            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id2' => $this->id2,
            'id3' => $this->id3,

        ]);

        $query->andFilterWhere(['like', 'name1', $this->name1])
            ->andFilterWhere(['like', 'name2', $this->name2])
            ->andFilterWhere(['like', 'name3', $this->name3])
            ->andFilterWhere(['like', 'name4', $this->name4]);

        return $dataProvider;
    }


    public function rules(){
        return [
            [['id', 'id2', 'id3'], 'integer'],
            [['name1', 'name2', 'name3', 'name4'], 'string'],
            [['date'], 'date']
        ];
    }
}
