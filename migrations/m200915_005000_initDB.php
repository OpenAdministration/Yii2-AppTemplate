<?php




class m200915_005000_initDB extends \yii\db\Migration
{
    public function up() : bool
    {
        // this is example code
        $this->createTable('config', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'value' => $this->json(),
        ]);
         // please describe your own tables as well
        return true;
    }

    public function down() : bool
    {
        // undo
        $this->dropTable('config');
        return true;
    }
}