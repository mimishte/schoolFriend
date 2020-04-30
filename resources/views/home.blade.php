@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tasks
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_task">Add task</button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    No tasks
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="add_task">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{Form::label('text', 'Text')}}
        {{Form::text('text', '', ['data-id' => 'task_text'])}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save_task">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#save_task").click(function() {

            var taskText = $(this).data('id');
             
            $.ajax({
            type: 'POST',
            url: '/task/store',
            data: {
                task_text : taskText

            },
            success: function(data) {

                $('.add_task').empty().append(data).modal();

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