@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card" id="tasks-list">
                <div class="card-header">
                    Задачи
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#add_task">Нова задача</button>
                </div>

                <div class="card-body">
                    @if (session('status')) 
                        {{ session('status') }}   
                    @endif
                    @if(count($tasks) > 0)
                        @foreach($tasks as $task)
                        <p class="card-text">
                            {{$task->text}}
                            <a href="" data-id="{{$task->id }}" class="float-right make_task_done">
                                Готово
                            </a>
                        </p>
                        @endforeach
                    @else
                        No tasks
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" id="done-tasks-list">
                <div class="card-header">
                    Завършени задачи
                </div>
                <div class="card-body">
                    @if (session('status')) 
                        {{ session('status') }}   
                    @endif
                    @if(count($doneTasks) > 0)
                        @foreach($doneTasks as $doneTask)
                        <p class="card-text">
                            {{$doneTask->text}}
                        </p>
                        @endforeach
                    @else
                        No done tasks
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="add_task">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Добави задача</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{Form::label('text', 'Текст')}}
        {{Form::text('text', '', ['data-id' => 'task_text'])}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save_task">Добави</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Затвори</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        
        $("#save_task").click(function() {

            var taskText = $('input[data-id=task_text]').val();
             
            $.ajax({
                type: 'POST',
                url: '/task',
                data: {
                    "_token": "{{ csrf_token() }}",
                    task_text : taskText

                },
                success: function(data) {
                    $('input[data-id=task_text]').val('')
                    $('#add_task').modal('toggle');
                    $("#tasks-list").load(" #tasks-list > *");

                },
                error: function(xhr, textStatus, thrownError) {
                }
            });
        });

        $(".make_task_done").click(function() {
        
            var taskId = $(this).data('id');
             
             $.ajax({
                type: 'PUT',
                url: '/task/{'+taskId+'}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    task_id : taskId
                },
                success: function(data) {
                    $("#tasks-list").load("#tasks-list > *");
                    $("#done-tasks-list").load("#done-tasks-list > *");
                },
                error: function(xhr, textStatus, thrownError) {
                }
            });
        });
    });
</script>
@endsection
@section('javascript')

@endsection