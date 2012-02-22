<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;
    private $_name;

    /**
     * Authenticates a user.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $auth = array("authenticate" => false);
        Yii::import("application.modules.usermanager.models.*", true);
        if (md5($this->username . $this->password) == md5(Setting::in()->superUser["login"] . Setting::in()->superUser['password'])) {
            $this->setSuperUser();
            $auth["authenticate"] = true;
        } else {
            $user = User::model()->find("user_login=? AND user_password=?", Array($this->username, md5($this->password)));
            if ($user === null) {
                $auth["authenticate_error"] = "errorsystemMessageAvtorization";
            } else if ($user->user_status) {
                $auth["authenticate"] = true;
                $this->_id = $user->user_id;
                $this->_name = $user->name;
                $this->setState('group', $user->group_role_id);
                $this->setState('permission', self::getPermissionByGroupId($user->group_role_id));
            } else {
                $auth["authenticate_error"] = "errorsystemMessageAvtorizationBadStatus";
            }
        }
        return $auth;
    }

    public function getId() {
        return $this->_id;
    }

    public function getName() {
        return $this->_name;
    }

    private function setSuperUser() {
        $this->_id = "666";
        $this->_name = "SU";
        $this->setState('group', md5("super"));
        $this->setState('permission', self::getPermissionByGroupId(md5("super")));
    }

    static public function getPermissionByGroupId($groupID) {
        $command = Yii::app()->db->createCommand();
        if ($groupID === md5("super")) {
            $permission = $command
                    ->select('module_id as modul,permission_id as rights')
                    ->from("user_permission")
                    ->order("module_id")
                    ->queryAll();
        } else if ($groupID) {
            $permission = $command
                    ->select('group_permission')
                    ->from("user_group_role")
                    ->where('group_role_id=:id', array(':id' => $groupID))
                    ->queryRow();
            $permission = unserialize($permission['group_permission']);
        }
        $newarray = array("module_id" => array(), "permission" => array());
        foreach ($permission as $ar) {
            if (!in_array($ar["modul"], $newarray["module_id"]))
                $newarray["module_id"][] = $ar["modul"];
            if (is_array($ar["rights"])) {
                foreach ($ar["rights"] as $right)
                    $newarray["permission"][] = $right;
            } else {
                $newarray["permission"][] = $ar["rights"];
            }
        }
        return $newarray;
    }

}