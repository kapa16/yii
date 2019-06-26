<?php

namespace app\auth\rules;

use app\entities\task\Tasks;
use yii\rbac\Item;
use yii\rbac\Rule;

class TaskUsersRule extends Rule
{

    /**
     * Executes the rule.
     *
     * @param string|int $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[CheckAccessInterface::checkAccess()]].
     * @return bool a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params): bool
    {
        /** @var Tasks $task */
        $task = $params['task'] ?? null;
        if (!$task) {
            return false;
        }

        return ($task->creator_id == $user || $task->responsible_id == $user);
    }
}