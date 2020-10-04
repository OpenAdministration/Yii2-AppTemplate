<?php


namespace app\models\User;



use DateTime;

/**
 * Class AppUser
 * @package app\models\User
 * @property-read string $name
 * @property-read string $userName
 * @property-read string $email
 * @property-read int $status
 * @property-read DateTime $lastLogin
 * @property-read string $authSource
 */
abstract class AppUser extends \yii\web\User
{
    /**
     * @return bool if $this user is App Admin
     */
    abstract public function isAppAdmin() : bool;

    /**
     * @param $groups string|array one or many group names to check for. If multiple are given all of them have to fit
     * @return bool
     */
    abstract public function hasGroup($groups) : bool;

    /**
     * @param $groups string|array
     * @return void dies if any of the groups are not present
     */
    abstract public function requireGroup($groups) : void;

    abstract public function authSourceName() : string;

}