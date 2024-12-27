<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rules}}`.
 */
class m241218_121352_create_rules_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rules}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string('255')->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex(
            'idx-rules-user-id',
            '{{%rules}}',
            'user_id'
        );

        $this->addForeignKey(
            'fk-rules-user_id',
            '{{%rules}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
        'fk-rules-user_id',
        '{{%rules}}',
        );

        $this->dropTable('{{%rules}}');
    }
}
