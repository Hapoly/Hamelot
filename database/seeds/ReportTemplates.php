<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ReportTemplate;
use App\Models\ReportField;
class ReportTemplates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rp0 = ReportTemplate::create([
            'title'         => 'چکاپ RID',
            'description'   => 'چکاپ اولیه تمامی مولفه‌های RID',
            'status'        => 1,
        ]);

        ReportField::create([
            'title'                 => 'پلاکت',
            'description'           => 'میزان پلاکت خون',
            'label'                 => 'placet',
            'type'                  => 1,
            'report_template_id'    => $rp0->id,
            'quantity'              => 'gr',
        ]);
        ReportField::create([
            'title'                 => 'کلسترول',
            'description'           => 'میزان کلسترول خون',
            'label'                 => 'colestrol',
            'type'                  => 1,
            'report_template_id'    => $rp0->id,
            'quantity'              => 'ppm',
        ]);

        // ----------------------------

        $rp1 = ReportTemplate::create([
            'title'         => 'آزمایش کامل خون',
            'description'   => 'چکاپ کامل خون',
            'status'        => 1,
        ]);

        ReportField::create([
            'title'                 => 'پلاکت',
            'description'           => 'میزان پلاکت خون',
            'label'                 => 'placet',
            'type'                  => 1,
            'report_template_id'    => $rp1->id,
            'quantity'              => 'gr',
        ]);
        ReportField::create([
            'title'                 => 'کلسترول',
            'description'           => 'میزان کلسترول خون',
            'label'                 => 'colestrol',
            'type'                  => 1,
            'report_template_id'    => $rp1->id,
            'quantity'              => 'ppm',
        ]);

        ReportField::create([
            'title'                 => 'غلظت',
            'description'           => 'میزان غلظت خون',
            'label'                 => 'denst',
            'type'                  => 1,
            'report_template_id'    => $rp1->id,
            'quantity'              => '%',
        ]);
    }
}
