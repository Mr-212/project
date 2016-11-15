
        <h4>Message:</h4>
        <p>{{$text}}}</p>

        <h4>Details:</h4>
        <p>Project Name: {{$task->project->name or null}}</p>
        <p>Task Name: {{$task->name or null}}</p>
        <p>Sprint: {{$task->sprint->name or null}}</p>
    @if(!empty($task->closet_at))
        <p>Completed On: {{$task->closed_at or null}}</p>
    @else
        <p>Expire: {{$task->task_end or null}}</p>
    @endif



