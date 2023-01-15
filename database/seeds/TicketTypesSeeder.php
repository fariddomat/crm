<?php

use App\TicketClassification;
use App\TicketType;
use Illuminate\Database\Seeder;

class TicketTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = ['كيفية التقديم', 'تاريخ التقديم', 'معلومات حول المواد التعليمية', 'كيفية الانتقال إلى فرع داخل المملكة', 'كيفية الانتقال إلى فرع خارج المملكة', 'الضرائب السنوية', 'غير ذلك'];
        $type = TicketType::create([
            'name' => 'استفسار'
        ]);
        foreach ($c as $key => $value) {
            TicketClassification::create([
                'ticket_type_id' => $type->id,
                'name' => $value,
            ]);
        }

        $c1=['مشكلة في إيميل AOU', 'مشكلة في تسجيل الدخول إلى SIS', 'مشكلة في تسجيل الدخول إلى LMS', 'مشكلة في التسجيل على مقرر', 'مشكلة في الصفوف ال online', 'غير ذلك'];
        $type1 = TicketType::create([
            'name' => 'شكوى'
        ]);
        foreach ($c1 as $key => $value) {
            TicketClassification::create([
                'ticket_type_id' => $type1->id,
                'name' => $value,
            ]);
        }

        $type2 = TicketType::create([
            'name' => 'مقترح'
        ]);
    }
}
