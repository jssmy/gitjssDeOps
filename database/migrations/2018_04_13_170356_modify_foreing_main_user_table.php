<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyForeingMainUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $tables=['favorites','sprints','notes','user_stories','statuses','attachments'];

        foreach ($tables as $t) {
         if (!(Schema::hasColumn($t, 'main_user_id'))){
                    /// si no tiene que lo cee      
                    Schema::table($t, function (Blueprint $table) {
                        $table->integer('main_user_id')->unsigned();
                        
                        $table->foreign('main_user_id')
                        ->references('id')->on('main_users')
                        ->onDelete('cascade');
                    });
            
          }

        }
        $tables =[
            'favorites'=>'fk_favorites_user_id',
            'sprints'=>'fk_sprints_user_id',
            'notes'=>'fk_notes_user_id',
            'user_stories'=>'fk_user_stories_user_id',
            'statuses'=>'fk_statuses_users_id',
            'attachments'=>'fk_attachments_user_id'
            ];

            Schema::table('favorites', function(Blueprint $table){
                if(Schema::hasColumn('favorites','user_id')){
                    $table->dropForeign('fk_favorites_user_id');
                    $table->dropColumn('user_id');
                }

            });

            Schema::table('sprints', function(Blueprint $table){
                if(Schema::hasColumn('sprints','user_id')){
                    $table->dropForeign('fk_sprints_user_id');
                    $table->dropColumn('user_id');
                }
            });

            Schema::table('notes', function(Blueprint $table){
                if(Schema::hasColumn('notes','user_id')){
                    $table->dropForeign('fk_notes_user_id');
                    $table->dropColumn('user_id');
                }
            });

            Schema::table('user_stories', function(Blueprint $table){
                if(Schema::hasColumn('user_stories','user_id')){
                    $table->dropForeign('fk_user_stories_user_id');
                    $table->dropColumn('user_id');
                }
            });

            Schema::table('statuses', function(Blueprint $table){
                if(Schema::hasColumn('statuses','user_id')){
                    $table->dropForeign('fk_statuses_users_id');
                    $table->dropColumn('user_id');
                }
            });

            Schema::table('attachments', function(Blueprint $table){
                if(Schema::hasColumn('attachments','user_id')){
                    $table->dropForeign('fk_attachments_user_id');
                    $table->dropColumn('user_id');
                }
            });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
