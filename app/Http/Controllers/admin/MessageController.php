<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Fetch paginated messages (latest first) for AJAX load-more.
     */
    public function index(Request $request)
    {
        $perPage = 10;
        $page = (int) $request->get('page', 1);
        $search = $request->get('search', '');

        $query = Message::orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        $messages = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $messages->map(function ($m) {
                return [
                    'id'         => $m->id,
                    'name'       => $m->name,
                    'email'      => $m->email,
                    'subject'    => $m->subject,
                    'body'       => $m->body,
                    'initials'   => $m->initials,
                    'is_read'    => $m->is_read,
                    'time_short' => $m->created_at->format('M d, H:i'),
                    'time_full'  => $m->created_at->format('F j, Y \a\t g:i A'),
                    'created_at' => $m->created_at->toISOString(),
                ];
            }),
            'current_page'   => $messages->currentPage(),
            'last_page'      => $messages->lastPage(),
            'total'          => $messages->total(),
            'has_more_pages' => $messages->hasMorePages(),
        ]);
    }

    /**
     * Show a single message (and mark it as read).
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);

        // Mark as read when viewing
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id'         => $message->id,
                'name'       => $message->name,
                'email'      => $message->email,
                'subject'    => $message->subject,
                'body'       => $message->body,
                'initials'   => $message->initials,
                'is_read'    => true, // now read
                'time_full'  => $message->created_at->format('F j, Y \a\t g:i A'),
            ],
        ]);
    }

    /**
     * Mark a single message as read.
     */
    public function markRead($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Message marked as read.',
        ]);
    }

    /**
     * Mark all unread messages as read.
     */
    public function markAllRead()
    {
        $count = Message::where('is_read', false)->count();
        Message::where('is_read', false)->update(['is_read' => true]);

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $count . ' message' . ($count !== 1 ? 's' : '') . ' marked as read.',
                'count'   => $count,
            ]);
        }

        return back()->with('success', 'All messages marked as read.');
    }

    /**
     * Delete a single message.
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Message deleted.',
            ]);
        }

        return back()->with('success', 'Message deleted.');
    }

    /**
     * Delete all read messages.
     */
    public function clearRead()
    {
        $count = Message::where('is_read', true)->count();
        Message::where('is_read', true)->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $count . ' read message' . ($count !== 1 ? 's' : '') . ' cleared.',
                'count'   => $count,
            ]);
        }

        return back()->with('success', 'Read messages cleared.');
    }
}
