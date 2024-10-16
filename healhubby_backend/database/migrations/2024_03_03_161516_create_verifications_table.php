<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationsTable extends Migration
{
    public function up()
    {
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->string('article_title');
            $table->text('article_content');
            $table->string('article_image');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('verifications');
    }
}

