<?php

namespace Smartwebsource\RequestLogger\Http\Controllers;

use Illuminate\Routing\Controller;
use Smartwebsource\RequestLogger\Models\RequestLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RequestLogController extends Controller
{
    public function index(Request $request)
    {
        $query = RequestLog::with('user:id,email');

        if ($request->filled('method')) {
            $query->where('method', 'like', '%' . $request->method . '%');
        }

        if ($request->filled('type')) {
            $query->where('request_type', 'like', '%' . $request->type . '%');
        }

        if ($request->filled('url')) {
            $query->where('url', 'like', '%' . $request->url . '%');
        }

        if ($request->filled('header_input')) {
            $query->where('headers', 'like', '%' . $request->header_input . '%');
        }

        if ($request->filled('body')) {
            $query->where('body', 'like', '%' . $request->body . '%');
        }

        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->user . '%');
            });
        }

        if ($request->filled('created_at')) {
            $datePart = $request->created_at;
        }

        if ($request->filled('created_time')) {
            $timePart = $request->created_time;
        }

        if (!empty($datePart) && !empty($timePart)) {
            $fullDateTime = Carbon::parse($datePart . ' ' . $timePart)->format('Y-m-d H:i');
            $query->where('created_at', 'like', '%' . $fullDateTime . '%');
        } elseif (!empty($datePart)) {
            $query->whereDate('created_at', $datePart);
        } elseif (!empty($timePart)) {
            $query->whereTime('created_at', 'like', '%' . $timePart . '%');
        }

        $logs = $query->latest()->paginate(10);
        $logs->appends($request->all());

        if ($request->ajax()) {
            $formattedLogs = $logs->map(function ($log) {
                return [
                    'method' => $log->method,
                    'type' => $log->request_type,
                    'url' => $log->url,
                    'headers' => $log->headers,
                    'body' => $log->body,
                    'user' => $log->user,
                    'created_at' => $log->created_at->toDateTimeString(),
                ];
            });

            return response()->json([
                'logs' => $formattedLogs,
                'pagination' => (string) $logs->links(),
            ]);
        }

        return view('request_logs::index', compact('logs'));
    }

    public function truncate()
    {
        RequestLog::truncate();
        return redirect()->back()->with('success', 'Logs cleared.');
    }
}
