<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function event(Request $request)
    {
        session(['event_origin' => ['label' => 'Event Bulan Ini', 'url' => '/kegiatan/event-bulan-ini']]);

        $events = Event::with(['post', 'post.meta'])
            ->whereHas('post', function ($query) {
                $query->where('post_type', 'tribe_events')
                    ->where('post_status', 'publish');
            })
            ->when($request->search, function ($query, $search) {
                $query->whereHas('post', function ($postQuery) use ($search) {
                    $postQuery->where('post_title', 'like', '%' . $search . '%')
                        ->orWhere('post_content', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('start_date', 'asc')
            ->paginate(9);

        return view('layouts/kegiatan/event', compact('events'));
    }
    public function kalender(Request $request)
    {
        session(['event_origin' => ['label' => 'Kalender Event', 'url' => '/kegiatan/kalender-event']]);

        $currentMonth = $request->filled('month')
            ? Carbon::createFromFormat('Y-m', $request->month)->startOfMonth()
            : now()->startOfMonth();

        $startOfCalendar = $currentMonth->copy()->startOfWeek(Carbon::MONDAY);
        $endOfCalendar = $currentMonth->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        $events = Event::with(['post', 'post.meta'])
            ->whereHas('post', function ($query) {
                $query->where('post_type', 'tribe_events')
                    ->where('post_status', 'publish');
            })
            ->where('end_date', '>=', $startOfCalendar)
            ->where('start_date', '<=', $endOfCalendar)
            ->orderBy('start_date', 'asc')
            ->get();

        $eventsByDate = $events->groupBy(fn ($event) => Carbon::parse($event->start_date)->format('Y-m-d'));
        $calendarDays = collect();

        for ($date = $startOfCalendar->copy(); $date->lte($endOfCalendar); $date->addDay()) {
            $calendarDays->push($date->copy());
        }

        $selectedEvent = $events->first(fn ($event) => now()->between(Carbon::parse($event->start_date), Carbon::parse($event->end_date)))
            ?? $events->first(fn ($event) => Carbon::parse($event->start_date)->isToday())
            ?? $events->first(fn ($event) => Carbon::parse($event->start_date)->gte(now()))
            ?? $events->first();

        return view('layouts/kegiatan/kalender', compact('currentMonth', 'events', 'eventsByDate', 'calendarDays', 'selectedEvent'));
    }
    public function detail($slug = null)
    {
        if (!$slug) {
            return redirect('/kegiatan/event-bulan-ini');
        }

        $event = Event::with(['post', 'post.meta'])
            ->whereHas('post', function ($query) {
                $query->where('post_type', 'tribe_events')
                    ->where('post_status', 'publish');
            })
            ->where(function ($query) use ($slug) {
                $query->whereHas('post', function ($postQuery) use ($slug) {
                    $postQuery->where('post_name', $slug);
                });

                if (ctype_digit((string) $slug)) {
                    $query->orWhere('event_id', $slug);
                }
            })
            ->firstOrFail();

        return view('layouts/kegiatan/detail-event', compact('event'));
    }
}
