<?php

namespace App\Http\Controllers;

use App\Models\Redirect;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index(): View
    {
        return view('tickets.index', [
            'tickets' => Ticket::sortable()->filter(request(['search']))->simplePaginate(12),
            'users' => User::class,
        ]);
    }

    public function create(): View
    {
        return view('tickets.create');
    }

    public function show(Ticket $ticket): View
    {
        return view('tickets.show', [
            'ticket' => $ticket,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'priority' => 'required',
        ],
        [],
            [
                'title' => __('app.title'),
                'description' => __('app.description'),
                'deadline' => __('app.deadline'),
                'priority' => __('app.priority')
            ]
        );

        /* @var User $user */
        $user = auth()->user();

        $formFields += [
            'sender_id' => $user->id,
        ];

        Ticket::create($formFields);

        return redirect('tickets')->with('message', __('app.ticket.create'));
    }

    public function redirection(Ticket $ticket): View
    {
        $users = User::with('redirects')->get(['id', 'first_name', 'last_name']);

        return view('tickets.redirection', [
            'ticket' => $ticket,
            'users' => $users,
            'redirects' => Redirect::where('ticket_id', $ticket->id)->get(),
        ]);
    }

}
