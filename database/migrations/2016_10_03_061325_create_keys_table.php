<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'keys', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'username', 32 )->comment( '申请人用户名' );
            $table->string( 'key', 32 )->comment( 'key' );
            $table->string( 'realname', 32 )->comment( '申请人姓名' );
            $table->string( 'email', 64 )->comment( '申请人邮箱' );
            $table->string( 'tel', 16 )->comment( '申请人电话' );
            $table->tinyInteger( 'status' )->default( 1 )->comment( '是否生效' );
            $table->softDeletes();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop( 'keys' );
    }
}
