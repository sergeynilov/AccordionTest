<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();

            $table->string('title', 255);
            $table->mediumText('text');

            $table->string('client_name', 255);
            $table->string('client_email', 255);

            $table->foreignId('author_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->boolean('answered')->default(false);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->index(['title'], 'claims_title_index');
            $table->index(['author_id', 'client_email', 'answered'], 'claims_author_id_client_email_answered_index');
        });
        \Artisan::call('db:seed', array('--class' => 'claimWithInitData'));

         /* *ID, тема, сообщение, имя клиента, почта клиента, ссылка на прикрепленный файл, время создания */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claims');
    }
};
