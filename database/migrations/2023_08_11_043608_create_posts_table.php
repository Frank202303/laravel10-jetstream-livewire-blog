<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('cover_image');
            $table->string('title');
            $table->string('slug');
            $table->longText('body');
            // 可空 的
            $table->text('meta_description')->nullable();
            // no           s
            $table->timestamp('published_at')->nullable();
            // 默认值 0：即 false
            $table->boolean('featured')->default(0);

            // 外键
            //代码是在创建一个外键关系。
            // 这行代码在 Laravel 的数据库迁移中定义了一个外键关系，将当前表格的 author_id 列与 users 表中的主键列建立了关联

            // foreignId('author_id')：这部分代码表示在表格中创建一个名为 author_id 的外键列。
            // 这个外键列会与 users 表中的某个主键列建立关联

            // constrained('users')：这部分代码表示将刚刚创建的 author_id 外键列与 users 表进行关联

            // 这种外键关系的作用是确保在数据库层面维护数据的完整性，通过限制外键列的值只能是被关联表中存在的主键值，从而保证了数据的一致性和准确性。

            $table->foreignId('author_id')->constrained('users');


            /// foreignId('category_id'): 创建一个名为 category_id 的外键列
            // constrained:将刚刚创建的 category_id 外键列与 categories 表进行关联

            // onDelete('cascade')：这部分代码指定了当父表中的一行数据被删除时，对应的子表中的数据应该如何处理。
            // 具体地说，cascade 表示级联删除。
            // 如果在 categories 表中删除了某一行，那么与该行关联的所有子表中的数据也会被自动删除。
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
