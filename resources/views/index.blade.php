@extends(config('api_request_logs.layout'))

@section('content')
    <div class="container">
        <h1>API Request Logs</h1>
        <form action="{{ route('api_request_logs.truncate') }}" method="POST" style="margin-bottom: 20px;">
            @csrf
            <button type="submit" class="btn btn-danger">Clear All Logs</button>
        </form>
        <div class="table-responsive">
            <table class="table table-info table-bordered align-middle" style="table-layout: fixed; width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 100px;">Method</th>
                        <th style="width: 400px;">URL</th>
                        <th style="width: 450px;">Headers</th>
                        <th style="width: 450px;">Body</th>
                        <th style="width: 200px;">Created Date Time</th>
                    </tr>
                    <tr>
                        <!-- Filter inputs -->
                        <th><input type="text" class="form-control form-control-sm" id="filter-method"
                                placeholder="Method"></th>
                        <th><input type="text" class="form-control form-control-sm" id="filter-url" placeholder="URL">
                        </th>
                        <th><input type="text" class="form-control form-control-sm" id="filter-headers"
                                placeholder="Headers"></th>
                        <th><input type="text" class="form-control form-control-sm" id="filter-body" placeholder="Body">
                        </th>
                        <th>
                            <input type="date" class="form-control form-control-sm" id="filter-created-at"
                                placeholder="Date">
                            <input style="margin-top: 3px;" type="text" class="form-control form-control-sm"
                                id="filter-created-time" placeholder="Time (HH:MM)">
                        </th>

                    </tr>
                </thead>
                <tbody id="log-tbody">
                    @foreach ($logs as $log)
                        <tr style="height: 120px;">
                            <td>
                                <div style="height: 200px; max-width: 100%; white-space: nowrap;">{{ $log->method }}</div>
                            </td>
                            <td>
                                <div style="max-height: 200px; max-width: 100%; word-wrap: break-word;">{{ $log->url }}
                                </div>
                            </td>
                            <td>
                                <div style="height: 200px; max-width: 100%; overflow-x: auto; white-space: pre;">
                                    <pre style="margin:0; font-size: 12px;">{{ json_encode($log->headers ?? [], JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            </td>
                            <td>
                                <div style="height: 200px; max-width: 100%; overflow-x: auto; white-space: pre;">
                                    <pre style="margin:0; font-size: 12px;">{{ json_encode($log->body ?? [], JSON_PRETTY_PRINT) }}</pre>
                                </div>
                            </td>
                            <td>
                                <div style="height: 200px; max-width: 100%; overflow-x: auto; white-space: nowrap;">
                                    {{ $log->created_at }}</div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div id="pagination-links" class="mt-3">
            {{ $logs->links() }}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchLogs(page = 1) {
                var method = $('#filter-method').val();
                var url = $('#filter-url').val();
                var headers = $('#filter-headers').val();
                var body = $('#filter-body').val();
                var created_at = $('#filter-created-at').val();
                var created_time = $('#filter-created-time').val();

                $.ajax({
                    url: "{{ route('api_request_logs.index') }}" + "?page=" + page,
                    type: "GET",
                    data: {
                        method: method,
                        url: url,
                        header_input: headers,
                        body: body,
                        created_at: created_at,
                        created_time: created_time,
                    },
                    success: function(response) {
                        var tbody = $('#log-tbody');
                        tbody.empty();

                        $.each(response.logs, function(index, log) {
                            var row = `
                        <tr style="height: 120px;">
                            <td><div style="height: 200px; max-width: 100%; white-space: nowrap;">${log.method}</div></td>
                            <td><div style="max-height: 200px; max-width: 100%; word-wrap: break-word;">${log.url}</div></td>
                            <td><div style="height: 200px; max-width: 100%; overflow-x: auto; white-space: pre;"><pre style="margin:0; font-size: 12px;">${JSON.stringify(log.headers, null, 2)}</pre></div></td>
                            <td><div style="height: 200px; max-width: 100%; overflow-x: auto; white-space: pre;"><pre style="margin:0; font-size: 12px;">${JSON.stringify(log.body, null, 2)}</pre></div></td>
                            <td><div style="height: 200px; max-width: 100%; overflow-x: auto; white-space: nowrap;">${log.created_at}</div></td>
                        </tr>
                    `;
                            tbody.append(row);
                        });

                        $('#pagination-links').html(response.pagination);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            // Listen for input events
            $('#filter-method, #filter-url, #filter-headers, #filter-body, #filter-created-at, #filter-created-time')
                .on('input change',
                    function() {
                        fetchLogs();
                    });

            // Listen for pagination link clicks
            $(document).on('click', '#pagination-links a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var page = url.split('page=')[1];
                fetchLogs(page);
            });
        });
    </script>
@endsection
