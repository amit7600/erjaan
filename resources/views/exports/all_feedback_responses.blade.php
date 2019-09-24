<table>
    <thead>
        <tr>
            <th>Day</th>
            <th>Responses</th>
            <th>5 Star</th>
            <th>4 Star</th>
            <th>3 Star</th>
            <th>2 Star</th>
            <th>1 Star</th>
        </tr>
    </thead>
    <tbody>
        <tr></tr>
        @foreach($responses as $key => $getResponse)
        <tr>
            <td>{{ $getResponse->date }}</td>
            <td>{{ $getResponse->responses }}</td>
            @php
            $fantastic = DB::table('feedback_survey')->whereDate('created_at', $getResponse->full_date)->where('rating', 5)->count();
                    $total_count = DB::table('feedback_survey')->whereDate('created_at', $getResponse->full_date)->count();
                    $fantastic_percentage = $fantastic * 100 / $total_count;
            @endphp
            <td>{{ round($fantastic_percentage, 1) . '%(' . $fantastic . ')' }}</td>
            @php 
                $good = DB::table('feedback_survey')->whereDate('created_at', $getResponse->full_date)->where('rating', 4)->count();

                $total_count = DB::table('feedback_survey')->whereDate('created_at', $getResponse->full_date)->count();
                $good_percentage = $good * 100 / $total_count;
            @endphp
            <td>{{ round($good_percentage, 1) . '%(' . $good . ')' }}</td>
            @php
                $average = DB::table('feedback_survey')->whereDate('created_at', $getResponse->full_date)->where('rating', 3)->count();
                $total_count = DB::table('feedback_survey')->whereDate('created_at', $getResponse->full_date)->count();
                $average_percentage = $average * 100 / $total_count;
            @endphp
            <td>{{ round($average_percentage, 1) . '%(' . $average . ')' }}</td>
            @php
                $poor = DB::table('feedback_survey')->whereDate('created_at', $getResponse->full_date)->where('rating', 2)->count();
                $total_count = DB::table('feedback_survey')->whereDate('created_at', $getResponse->full_date)->count();
                $poor_percentage = $poor * 100 / $total_count;
            @endphp
            <td>{{ round($poor_percentage, 1) . '%(' . $poor . ')' }}</td>   
            @php
                $very_poor = DB::table('feedback_survey')->whereDate('created_at', $getResponse->full_date)->where('rating', 1)->count();
                    $total_count = DB::table('feedback_survey')->whereDate('created_at', $getResponse->full_date)->count();
                    $very_poor_percentage = $very_poor * 100 / $total_count;
            @endphp
            <td>{{ round($very_poor_percentage, 1) . '%(' . $very_poor . ')' }}</td>         
        </tr>
        @endforeach
    </tbody>
</table>