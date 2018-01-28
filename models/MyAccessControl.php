<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\models;

use Yii;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\User;

/**
 * AccessControl provides simple access control based on a set of rules.
 *
 * AccessControl is an action filter. It will check its [[rules]] to find
 * the first rule that matches the current context variables (such as user IP address, user role).
 * The matching rule will dictate whether to allow or deny the access to the requested controller
 * action. If no rule matches, the access will be denied.
 *
 * To use AccessControl, declare it in the `behaviors()` method of your controller class.
 * For example, the following declarations will allow authenticated users to access the "create"
 * and "update" actions and deny all other users from accessing these two actions.
 *
 * ```php
 * public function behaviors()
 * {
 *     return [
 *         'access' => [
 *             'class' => \yii\filters\AccessControl::className(),
 *             'only' => ['create', 'update'],
 *             'rules' => [
 *                 // deny all POST requests
 *                 [
 *                     'allow' => false,
 *                     'verbs' => ['POST']
 *                 ],
 *                 // allow authenticated users
 *                 [
 *                     'allow' => true,
 *                     'roles' => ['@'],
 *                 ],
 *                 // everything else is denied
 *             ],
 *         ],
 *     ];
 * }
 * ```
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MyAccessControl extends AccessControl
{
    /**
     * @var User|array|string|false the user object representing the authentication status or the ID of the user application component.
     * Starting from version 2.0.2, this can also be a configuration array for creating the object.
     * Starting from version 2.0.12, you can set it to `false` to explicitly switch this component support off for the filter.
     */
    public $user = 'user';
    
    protected function denyAccess($user)
    {
        if ($user !== false && $user->getIsGuest()) {
            $user->loginRequired();
        } else {
            throw new ForbiddenHttpException(Yii::t('yii', 'Действие недоступно'));
        }
    }
}
