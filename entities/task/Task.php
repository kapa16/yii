<?php

namespace app\entities\task;

use app\helpers\TaskHelper;
use app\models\User;
use DateTime;
use Faker\Factory;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $title
 * @property int $type
 * @property int $status
 * @property int $priority
 * @property string $description
 * @property User $author
 * @property User $implementer
 * @property DateTime $created
 * @property DateTime $updated
 */
class Task extends ActiveRecord
{

    public static function generate(): array
    {
        $faker = Factory::create();
        $tasks = [];
        for ($i = 1; $i <= 50; $i++) {
            $tasks[$i] = [
                'id' => $i,
                'title' => $faker->text(15),
                'type' => $faker->randomElement(TaskHelper::typesList()),
                'status' => $faker->randomElement(TaskHelper::statusList()),
                'priority' => $faker->numberBetween(1,10),
                'description' => $faker->text(),
                'author' => $faker->firstName . $faker->lastName,
                'implementer' => $faker->firstName . $faker->lastName,
                'created' => $faker->dateTime(),
                'updated' => $faker->dateTime(),
            ];
        }
        return $tasks;
    }
}