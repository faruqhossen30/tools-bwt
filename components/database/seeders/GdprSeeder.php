<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Gdpr;
use DateTime;
class GdprSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Gdpr::create(array(
            "id"         => 1,
            "notice"     => "We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.",
            "align"      => "text-center",
            "background" => "bg-white",
            "button"     => 1,
            "status"     => true,
            "created_at" => new DateTime(),
            "updated_at" => new DateTime()
          ));
    }
}
