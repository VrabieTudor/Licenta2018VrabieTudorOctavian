<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationships extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
		Schema::table("users", function(Blueprint $table) {
			$table->unsignedInteger("user_type_id")->default(null);
			$table->foreign("user_type_id", "user_type_id_foreign")->references("id")->on("user_types")->onDelete("cascade")->onUpdate("cascade");
		});

		Schema::table("user_permissions", function(Blueprint $table) {
			$table->dropColumn("user_type_id");
		});

		Schema::table("user_permissions", function(Blueprint $table) {
			$table->unsignedInteger("user_type_id")->nullable()->default(null)->after("id");
			$table->foreign("user_type_id", "user_permission_user_type_571_foreign")->references("id")->on("user_types")->onDelete("cascade")->onUpdate("cascade");
		});
        Schema::create('user_files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedInteger("file_id");
            $table->foreign("file_id")->references("id")->on("files")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
		Schema::table("users", function(Blueprint $table) {
			$table->dropForeign("user_type_id_foreign");
			$table->dropColumn("user_type_id");
		});

		Schema::table("user_permissions", function(Blueprint $table) {
			$table->dropForeign("user_permission_user_type_571_foreign");
			$table->dropColumn("user_type_id");
		});

		Schema::table("user_permissions", function(Blueprint $table) {
			$table->string("user_type_id")->nullable()->default(null)->after("id");
		});
		Schema::dropIfExists("user_files");
    }
}
