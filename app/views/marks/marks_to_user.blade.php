@extends('_layouts/default/index')

@section('title')
    My Marks @parent
@stop

@section('content')
    <section id="section-banner">
         <h1>All Marks</h1>
    </section>

    @if (!$marks)
       <div id="empty-data">You haven't completed any exams yet.</div>
    @else
        <section id="section-marks-to-user">
            <table id="marks" cellspacing="0" cellpadding="0">
                 <thead>
                     <tr>
                       <th><span>Date</span></th>
                       <th><span>Name of the Subject</span></th>
                       <th><span>Mark</span></th>
                     </tr>
                 </thead>

                 <tbody>
                    @foreach($marks as $mark)
                        <tr>
                            <td>{{{$mark->created_at}}}</td>
                            <td>{{{$mark->exam_name}}}</td>
                            <td>{{{$mark->mark}}}</td>
                        </tr>
                    @endforeach
                 </tbody>
            </table>

        </section>
    @endif
    <script>
        $(function(){
          $('#marks').tablesorter();
        });
    </script>
@stop