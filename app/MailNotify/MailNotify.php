<?php
namespace App\MailNotify;
use Mail;
class  MailNotify
{
    public static function notify($ticket)
    {

        $data = '';
        $title = '';
        $lang='ar';
        if ($ticket->profile->language == 'en') {
            $lang='en';
            if ($ticket->ticket_type->id == '1') {
                // inquiries
                if ($ticket->status == 'open') {
                    $title="Inquiry Ticket opened";
                    $data = "Hello" . $ticket->profile->first_name . ",
                        Thank you for reaching out with Arab Open University, your inquiry ticket number is #" . $ticket->id . "
                        We are pleased to be at your service.
                        Arab Open University
                        ";
                } elseif ($ticket->status == 'closed') {
                    $title="Inquiry Ticket closed";
                    $data = "Hello " . $ticket->profile->first_name . ",
                            Ticket #" . $ticket->id . " has been processed and successfully closed. We are pleased to be at your service.
                            Arab Open University
                            ";
                }
            } elseif ($ticket->ticket_type->id == '2') {
                    // complaints
                if ($ticket->status == 'open'){
                    $title="Complain Ticket opened";
                    $data="Hello " . $ticket->profile->first_name . ",
                    Thank you for reaching out with Arab Open University, your complain ticket number is #" . $ticket->id . ".
                    We are pleased to be at your service.
                    Arab Open University
                    ";
                }elseif ($ticket->status == 'closed') {
                    $title="Complain Ticket closed";
                    $data="Hello " . $ticket->profile->first_name . ",
                    Ticket #" . $ticket->id . " has been processed and successfully closed. We are pleased to be at your service.
                    Arab Open University
                    ";
                }
            }elseif ($ticket->ticket_type->id == '3') {
                // suggestions
                $title="Suggestion Ticket opened";
                $data="Hello " . $ticket->profile->first_name . ",
                Thank you for reaching out with Arab Open University, We appreciate your suggestion.
                We are pleased to be at your service.
                Arab Open University
                ";
            }
        } else {
            // arabic
            if ($ticket->ticket_type->id == '1') {
                // inquiries
                if ($ticket->status == 'open') {
                    $title="فتح تذكرة استفسار";
                    $data = "مرحبا " . $ticket->profile->first_name . "
                    شكرًا لك على تواصلكم مع الجامعة العربية المفتوحة، رقم تذكرة الاستفسار الخاص بك هو # " . $ticket->id . "
                    يسرنا أن نكون في خدمتكم
                    الجامعة العربية المفتوحة
                        ";
                } elseif ($ticket->status == 'closed') {
                    $title="اغلاق تذكرة استفسار";
                    $data = "مرحبا " . $ticket->profile->first_name . "
                    تمت معالجة التذكرة رقم " . $ticket->id . " بنجاح. يسرنا أن نكون في خدمتكم
                    الجامعة العربية المفتوحة
                    ";
                }
            } elseif ($ticket->ticket_type->id == '2') {
                    // complaints
                if ($ticket->status == 'open'){
                    $title="فتح تذكرة شكوى";
                    $data = "مرحبا " . $ticket->profile->first_name . "
                    شكرًا لك على تواصلكم مع الجامعة العربية المفتوحة، رقم تذكرة الشكوى الخاص بك هو # " . $ticket->id . "
                    يسرنا أن نكون في خدمتكم
                    الجامعة العربية المفتوحة
                       ";
                }elseif ($ticket->status == 'closed') {
                    $title="اغلاق تذكرة شكوى";
                    $data = "مرحبا " . $ticket->profile->first_name . "
                    تمت معالجة التذكرة رقم " . $ticket->id . " بنجاح. يسرنا أن نكون في خدمتكم
                    الجامعة العربية المفتوحة
                    ";
                }
            }elseif ($ticket->ticket_type->id == '3') {
                // suggestions
                $title="فتح تذكرة المقترح";
                $data="مرحبا " . $ticket->profile->first_name . "
                شكرًا لك على تواصلكم مع الجامعة العربية المفتوحة، نقدر لكم اقراحكم.
                يسرنا أن نكون في خدمتكم
                الجامعة العربية المفتوحة
                ";
            }

        }


        $info = array(
            'title' => $title,
            'data' => $data,
            'mail' => $ticket->profile->email,
            'name' => $ticket->profile->first_name,
            'lang'=> $lang
        );
        // dd($ticket->profile->language);
        Mail::send('mail', $info, function ($message) use ($ticket) {
            $message->to($ticket->profile->email, $ticket->profile->first_name)
                ->subject('Ticket');
            $message->from('crm.aou.2023@gmail.com', 'AOU CRM');
        });
    }
}
