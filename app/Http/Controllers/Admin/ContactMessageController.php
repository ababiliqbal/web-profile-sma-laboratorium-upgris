<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Menampilkan daftar semua pesan yang masuk.
     */
    public function index(Request $request)
    {
        $this->authorize('view-contact-messages');

        $query = ContactMessage::query();

        // Tambahkan filter pencarian jika perlu
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }

        $messages = $query->latest()->paginate(15)->withQueryString();

        return view('admin.contact-messages.index', compact('messages'));
    }

    /**
     * Menampilkan detail satu pesan dan menandainya sebagai sudah dibaca.
     */
    public function show(ContactMessage $contactMessage)
    {
        $this->authorize('view-contact-messages');

        // Tandai sebagai sudah dibaca jika belum
        if (!$contactMessage->is_read) {
            $contactMessage->update(['is_read' => true]);
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Menghapus pesan dari database.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $this->authorize('delete-contact-messages');

        $contactMessage->delete();

        return redirect()->route('dashboard.contact-messages.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
