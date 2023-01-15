<?php

use App\Branch;
use App\College;
use App\Specialization;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $college=College::create(['name'=>'كلية دراسات الحاسب الالي']);
        $s=['مسار تقنية المعلومات','مسار علوم الكمبيوتر','مسار الحوسبة مع الأعمال','مسار الشبكات والأمن','مسار تطوير الويب'];
        foreach ($s as $key => $value) {
            Specialization::create([
                'college_id'=>$college->id,
                'name'=>$value
            ]);
        }

        $college2=College::create(['name'=>'كلية دراسات إدارة الاعمال']);
        $s2=['مسار النظم الادارية','مسار التسويق','مسار المحاسبة','بكالوريوس المحاسبة باللغة العربية'];
        foreach ($s2 as $key => $value) {
            Specialization::create([
                'college_id'=>$college2->id,
                'name'=>$value
            ]);
        }

        $college3=College::create(['name'=>'كلية الدراسات اللغوية']);
        $s3=['مسار اللغة الانجليزية وأدابها'];
        foreach ($s3 as $key => $value) {
            Specialization::create([
                'college_id'=>$college3->id,
                'name'=>$value
            ]);
        }

        $branches=['الرياض (المقر الرئيسي)','الدمام','جدة','المدينة المنورة','الاحساء','حائل'];
        foreach ($branches as $key => $value) {
            Branch::create([
                'name'=>$value
            ]);
        }

    }
}
