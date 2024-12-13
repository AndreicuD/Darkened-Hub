<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%song}}".
 *
 * @property integer $id [int(11) unsigned (auto increment)]
 * @property integer $is_in_concert [tinyint(2) unsigned]
 * @property integer $setlist_spot [int(3) unsigned]
 * @property integer $state [int(3) unsigned]
 * @property string $title [varchar(254)]
 * @property string $artist [varchar(254)]
 * @property string $first_guitar [varchar(254)]
 * @property string $second_guitar [varchar(254)]
 * @property string $bass [varchar(254)]
 * @property string $drums [varchar(254)]
 * @property string $piano [varchar(254)]
 * @property string $first_voice [varchar(254)]
 * @property string $second_voice [varchar(254)]
 * @property integer $created_at [datetime]
 * @property integer $updated_at [timestamp = current_timestamp()]
 *
 * @property integer $page_size
 *
 * @property User $user
 */
class Song extends \yii\db\ActiveRecord
{
    public $page_size;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%song}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state', 'title'], 'required', 'on' => 'default'],
            [['state'], 'integer', 'max' => 5],
            [['setlist_spot'], 'integer', 'max' => 100],
            [['is_in_concert'], 'integer', 'max' => 1],
            [['title', 'artist', 'first_guitar', 'second_guitar', 'bass', 'drums', 'piano', 'first_voice', 'second_voice'], 'string', 'max' => 254],
            [['id', 'is_in_concert', 'setlist_spot', 'state', 'title', 'artist', 'first_guitar', 'second_guitar', 'bass', 'drums', 'piano', 'first_voice', 'second_voice', 'created_at', 'updated_at', 'page_size'], 'safe', 'on' => 'search'],
            [['id', 'is_in_concert', 'setlist_spot', 'state', 'title', 'artist', 'first_guitar', 'second_guitar', 'bass', 'drums', 'piano', 'first_voice', 'second_voice', 'created_at', 'updated_at', 'page_size'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'is_in_concert' => Yii::t('app', 'Is in concert?'),
            'setlist_spot' => Yii::t('app', 'Setlist Spot'),
            'state' => Yii::t('app', 'State'),
            'title' => Yii::t('app', 'Title'),
            'artist' => Yii::t('app', 'Artist'),
            'first_guitar' => Yii::t('app', 'First Guitar'),
            'second_guitar' => Yii::t('app', 'Second Guitar'),
            'bass' => Yii::t('app', 'Bass'),
            'drums' => Yii::t('app', 'Drums'),
            'piano' => Yii::t('app', 'Piano'),
            'first_voice' => Yii::t('app', 'First Voice'),
            'second_voice' => Yii::t('app', 'Second Voice'),
            'page_size' => Yii::t('app', 'Page size'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $full = false)
    {
        $this->scenario = 'search';

        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => ['setlist_spot'=>SORT_ASC],
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

    // Filter conditions

        if ($full) {
            $dataProvider->setPagination(false);
        } else {
            $dataProvider->pagination->pageSize = ($this->page_size > 0) ? $this->page_size : 10;
        }

        $query->andFilterWhere(['state' => $this->state]);
        $query->andFilterWhere(condition: ['is_in_concert' => $this->is_in_concert]);
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'artist', $this->artist]);
        $query->andFilterWhere(['like', 'first_guitar', $this->first_guitar]);
        $query->andFilterWhere(['like', 'second_guitar', $this->second_guitar]);
        $query->andFilterWhere(['like', 'bass', $this->bass]);
        $query->andFilterWhere(['like', 'drums', $this->drums]);
        $query->andFilterWhere(['like', 'piano', $this->piano]);
        $query->andFilterWhere(['like', 'first_voice', $this->first_voice]);
        $query->andFilterWhere(['like', 'second_voice', $this->second_voice]);
        $query->andFilterWhere(['like', 'created_at', $this->created_at]);
        $query->andFilterWhere(['like', 'updated_at', $this->updated_at]);
        

        return $dataProvider;
    }

    /**
     * returns the list of possible states
     * to return a certain state (for ex. for Great): Song::stateList()['4'];
     * @return array
     */
    public static function stateList()
    {
        return [
            '5' => Yii::t('app', 'Not done yet'),
            '4' => Yii::t('app', 'Great'),
            '3' => Yii::t('app', 'Ok'),
            '2' => Yii::t('app', 'Could be better..'),
            '1' => Yii::t('app', 'Bad'),
        ];
    }
}
