<?php

/**
 * @property integer $user_id
 * @property integer $group_role_id
 * @property string $user_login
 * @property string $user_password
 * @property string $email
 * @property string $name
 * @property integer $date_registr
 * @property integer $date_lastUpdate
 * @property integer $user_status
 * 
 */
class User extends CMyActiveRecord {

    public $newPassword;

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'user_table';
    }

    public function getTableSchema() {
        $table = parent::getTableSchema();
        $table->columns['group_role_id']->isForeignKey = true;
        $table->foreignKeys['group_role_id'] = array('GroupRole', 'group_role_id');
        return $table;
    }
    
    
    public function rules() {

        return array(
            array('group_role_id, user_login, user_password,name,user_status', 'required'),
            array('group_role_id,user_status', 'numerical', 'integerOnly' => true),
            array('user_login', 'length', 'max' => 32),
            array('user_password, email, name', 'length', 'max' => 64),
            array('user_password, newPassword', 'length', 'min' => 3),
            array('email', 'email'),
        );
    }

    public function relations() {
        return array(
            'group' => array(self::BELONGS_TO, 'GroupRole', 'group_role_id',),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'group_role_id' => Translater::getDictionary()->usermanagerUserGroupId,
            'user_login' => Translater::getDictionary()->usermanagerUserLogin,
            'user_password' => Translater::getDictionary()->usermanagerUserPassword,
            'email' => Translater::getDictionary()->usermanagerUserEmail,
            'name' => Translater::getDictionary()->usermanagerUserName,
            'newPassword' => Translater::getDictionary()->usermanagerUserNewPassword,
            'user_status'=>Translater::getDictionary()->usermanagerUserStatus,
        );
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->user_password = md5($this->user_password);
                $this->date_registr = Time::getCurrentTime();
                return true;
            } else {
                if ($this->newPassword) {
                    $this->user_password = md5($this->newPassword);
                }
                $this->date_lastUpdate = Time::getCurrentTime();
                return true;
            }
        }
        else
            return false;
    }

}