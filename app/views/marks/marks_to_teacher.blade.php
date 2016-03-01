@extends('_layouts/default/index')

@section('title')
    Marks @parent
@stop

@section('content')
    <section id="section-banner">
         <h1>Class book</h1>
    </section>

    @if (!isset($marks[0]->email))
        <div id="empty-data">Nobody has done your exams yet.</div>
    @else
        <section id="section-marks-to-user">
            <table id="marks" cellspacing="0" cellpadding="0">
                 <thead>
                     <tr>
                       <th><span>Student Name</span></th>
                       <th><span>Student Email</span></th>
                       <th><span>Faculty Number</span></th>
                       <th><span>Subject Name</span></th>
                       <th><span>Exam Name</span></th>
                       <th><span>Mark</span></th>
                       <th><span>Date</span></th>
                     </tr>
                 </thead>

                 <tbody>
                    @foreach($marks as $dt)
                        @if($dt->email)
                            <tr>
                                <td>{{{$dt->fname}}} {{{$dt->lname}}}</td>
                                <td>{{{$dt->email}}}</td>
                                <td>{{{$dt->faculty_number}}}</td>
                                <td>{{{$dt->subject_name}}}</td>
                                <td>{{{$dt->exam_name}}}</td>
                                <td>{{{$dt->mark}}}</td>
                                <td>{{{$dt->created_at}}}</td>
                            </tr>
                        @endif
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