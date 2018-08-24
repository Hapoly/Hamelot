<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportTemplates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_templates')->insert([
            'title'         => 'چکاپ RID',
            'description'   => 'چکاپ اولیه تمامی مولفه‌های RID',
            'status'        => 1,
        ]);

        DB::table('report_fields')->insert([
            'title'                 => 'پلاکت',
            'description'           => 'میزان پلاکت خون',
            'label'                 => 'placet',
            'type'                  => 1,
            'report_template_id'    => 1,
            'quantity'              => 'gr',
        ]);
        DB::table('report_fields')->insert([
            'title'                 => 'کلسترول',
            'description'           => 'میزان کلسترول خون',
            'label'                 => 'colestrol',
            'type'                  => 1,
            'report_template_id'    => 1,
            'quantity'              => 'ppm',
        ]);
    }
}
