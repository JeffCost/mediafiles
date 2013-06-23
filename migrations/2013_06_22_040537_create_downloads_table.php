<?php

class Mediafiles_Create_Downloads_Table {

    /**
     * Make changes to the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_files', function($table)
        {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('description', 1000)->default('');
            $table->string('version', 100)->default('');
            $table->string('image_name')->default('');
            $table->string('file_name');
            $table->integer('category_id')->default(0);
            $table->boolean('status')->default(1);
            $table->integer('count')->default(0);
            $table->integer('order')->default(9999);
            $table->timestamps();
        });
    }

    /**
     * Revert the changes to the database.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('media_files');
    }
}