<header>
  <nav>
    <div id="logo">
      <a href="/">Laravel Quiz</a>
    </div>

    <div id="links" class="clearfix">
      <ul>
       @if(checkForTeacherRights())
           <li>{{link_to_route('createExam','Create a new test')}}</li>
           <li>{{link_to_route('createSubject','Create a new subject')}}</li>
       @endif
           <li><a href="/">{{{$currentUser->fname}}} &or;</a>
                <ul id="drop-down">
                 @if(checkForAdminRights())
                     <li><a href="{{ URL::to('admin') }}">Admin Panel</a></li>
                 @elseif(checkForTeacherRights())
                     <li>{{link_to_route('showAllExamsToSpecTeacher','My Exams',$currentUser->user_id)}}</li>
                     <li>{{link_to_route('showMarksTeacher','Class Book',$currentUser->user_id)}}</li>
                 @elseif(normalUser())
                     <li>{{link_to_route('showMarksUser','My Marks',$currentUser->user_id)}}</li>
                 @endif
                 <li>{{link_to_route('logout','Logout')}}</li>
                </ul>
           </li>
      </ul>
    </div>
  </nav>
</header>
