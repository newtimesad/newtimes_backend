<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Class m220310_214554_remove_location_table
 */
class m220310_214554_remove_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-location_id-post_location', "post_location");
        $postLocations = (new Query())
            ->select([
                "post_location.id as plId",
                "post_location.post_id",
                "post_location.location_id",
                "location.id as locationId",
                "location.city_id as cityId",
            ])
            ->from("post_location")
            ->innerJoin('location', 'location.id=post_location.location_id')
            ->all();
        foreach ($postLocations as $postLocation){
            Yii::$app->db->createCommand()
                ->update(
                    "post_location",
                    ["location_id" => $postLocation['cityId']],
                    ["id" => $postLocation['plId']]
                )
                ->execute();
        }

        $this->addForeignKey(
            'fk-location_id-post_location',
            'post_location',
            'location_id',
            'city',
            'id'
        );

        $this->dropTable('location');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220310_214554_remove_location_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220310_214554_remove_location_table cannot be reverted.\n";

        return false;
    }
    */
}
