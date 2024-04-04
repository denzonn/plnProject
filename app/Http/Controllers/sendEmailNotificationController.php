<?php

namespace App\Http\Controllers;

use App\Models\Materials;
use App\Mail\sendEmailNotification;
use Illuminate\Support\Facades\Mail;

class sendEmailNotificationController extends Controller
{
    public function index()
    {
        $materials = Materials::orderBy('updated_at', 'desc')->whereColumn('new_stock', '<=', 'limit_stock')->get();

        $materials_data = [
            'subject' => 'Materials Reaches of Limit',
            'sender_name' => 'pltgtello@gmail.com',
            'materials' => $materials, 
        ];

        Mail::to('pltgtello@gmail.com')->send(new sendEmailNotification($materials_data));

        return view('mail.sendNotification', compact('materials'));
    }
}

