<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%conditions}}`.
 */
class m241226_105716_create_conditions_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%conditions}}', [
            'id' => $this->primaryKey(),
            'field' => $this->integer()->notNull(),
            'operator' => $this->string(10)->notNull(),
            'rule_id' => $this->integer()->notNull(),
            'value' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull(),
        ]);

        // Создаем индекс для колонки `rule_id`
        $this->createIndex(
            'idx-conditions-rule_id',
            '{{%conditions}}',
            'rule_id'
        );

        // Добавляем внешний ключ для таблицы `rules`
        $this->addForeignKey(
            'fk-conditions-rule_id',
            '{{%conditions}}',
            'rule_id',
            '{{%rules}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаляем внешний ключ
        $this->dropForeignKey(
            'fk-conditions-rule_id',
            '{{%conditions}}'
        );

        // Удаляем индекс
        $this->dropIndex(
            'idx-conditions-rule_id',
            '{{%conditions}}'
        );

        // Удаляем таблицу
        $this->dropTable('{{%conditions}}');
    }
}
