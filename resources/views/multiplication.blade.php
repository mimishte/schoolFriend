@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card" id="tasks-list">
                <div class="card-header">
                    Умножение
                    <button type="button" class="btn btn-primary float-right" id="start">Старт</button>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        {{ Form::open() }}
                            @for($i = 1; $i < 10; $i++)
                                {{ Form::checkbox('numbers', null, false, ['class' => 'numbers', 'data-number' => $i]) }} {{$i}}
                            @endfor
                        {{ Form::close() }}
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <span id="multiplier1">множител</span> X <span id="multiplier2">множител</span> =
                    {{ Form::text('answer', '', ['id' => 'answer', 'style' => 'width:50px']) }}
                        <button type="button" class="btn btn-primary float-right" id="ok">OK</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">   
                            Верни: <span id="correct-answers" style="color:limegreen; font-weight:bold">0</span>
                        </div> 
                        <div class="col-md-4">   
                            Грешни: <span id="wrong-answers" style="color:red; font-weight:bold">0</span>
                        </div>
                        <div class="col-md-4">   
                            Общо: <span id="all-answers" style="font-weight:bold">0</span>
                        </div>
                    </div> 
                    <div class="row" id="picture-result">
                        
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        
        $("#start").click(function() {

            setMultipliers();
            $('#picture-result').html('');
            
        });

        $("#ok").click(function() {

            var answer = $("#answer").val();
            var result = parseInt($("#multiplier1").text()) * parseInt($("#multiplier2").text());
            var square_color = '';
            var all_answers = parseInt($("#all-answers").text())+1;
            
            if(answer == result) {
                square_color = 'limegreen';
                var correct_answers = parseInt($("#correct-answers").text())+1;
                $("#correct-answers").text(correct_answers)
            } else {
                square_color = 'red';
                var wrong_answers = parseInt($("#wrong-answers").text())+1;
                $("#wrong-answers").text(wrong_answers)
            }

            $("#picture-result").append('<div class="col-md-1"><div style="width:10px; height: 10px; margin-top:10px; background-color: ' + square_color + ';"> </div></div>');    
            $("#answer").val('');
            $("#all-answers").text(all_answers);
            setMultipliers();

        });

        function setMultipliers(){
            var all_checkboxes = [];
            $('.numbers:checkbox:checked').each(function () {
                 all_checkboxes.push($(this).data('number'));
            });
                //alert(all_checkboxes);
                
            var multiplier1 = all_checkboxes[Math.floor(Math.random() * all_checkboxes.length)];
            var multiplier2 = Math.floor(Math.random() * 9) + 1;
            $("#multiplier1").html(multiplier1);
            $("#multiplier2").html(multiplier2);
        }

    });
</script>
@endsection
@section('javascript')

@endsection