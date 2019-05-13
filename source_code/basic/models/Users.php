<?php
namespace app\models;

use Yii;
use app\models\Users;


class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const ROLE_DRIVER = 10;
    const ROLE_FORWARDER = 60;
    const ROLE_ADMIN = 100;

    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'realname', 'created'], 'required'],
            [['enabled', 'role'], 'integer'],
            [['created', 'lastlogin'], 'safe'],
            [['username'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 200],
            [['email','authkey'], 'string', 'max' => 400],
            [['realname'], 'string', 'max' => 500],
            [['rfid'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Felhasználónév'),
            'password' => Yii::t('app', 'Jelszó'),
            'email' => Yii::t('app', 'E-mail'),
            'realname' => Yii::t('app', 'Név'),
            'enabled' => Yii::t('app', 'Engedélyezve'),
            'created' => Yii::t('app', 'Regisztrálva'),
            'rfid' => Yii::t('app', 'RFID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransports()
    {
        return $this->hasMany(Transport::className(), ['driving_userid' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return  new static(Users::findOne($id));
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $users = Users::find()->all();
        foreach ($users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authkey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authkey)
    {
        return $this->authkey === $authkey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === crypt($password, $this->password);
//        return $this->password === $password;
    }
}
