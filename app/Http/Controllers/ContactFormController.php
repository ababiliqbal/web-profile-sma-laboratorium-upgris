<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function create()
    {
        return view('public.contact-messages.create');
    }

    public function store(StoreContactMessageRequest $request)
    {
        // Validasi sudah otomatis ditangani oleh StoreContactMessageRequest
        ContactMessage::create($request->validated());

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Terima kasih! Pesan Anda berhasil terkirim. Kami akan segera merespons.');
    }
}
