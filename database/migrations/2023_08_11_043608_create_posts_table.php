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
            //
            $table->text('meta_description')->nullable();
            // no           s
            $table->timestamp('published_at')->nullable();
            // Default value 0: false
            $table->boolean('featured')->default(0);

            // Foreign Keys
            // The code is creating a foreign key relationship.
            // This line of code defines a foreign key relationship in Laravel's database migration, associating the author_id column of the current table with the primary key column in the users table

            // foreignId('author_id'): This part of the code means creating a foreign key column named author_id in the table.
            // This foreign key column will be associated with a primary key column in the users table

            // constrained('users'): This part of the code means associating the author_id foreign key column just created with the users table

            // The purpose of this foreign key relationship is to ensure the integrity of the data at the database level, by limiting the value of the foreign key column to only the primary key value that exists in the associated table, thereby ensuring the consistency and accuracy of the data.

            $table->foreignId('author_id')->constrained('users');


            /// foreignId('category_id'): Create a foreign key column named category_id
            // constrained: Associate the newly created category_id foreign key column with the categories table

            // onDelete('cascade'): This part of the code specifies how the corresponding child table data should be handled when a row of data in the parent table is deleted.
            // Specifically, cascade means cascade deletion.
            // If a row is deleted in the categories table, the data in all child tables associated with the row will also be automatically deleted.
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
