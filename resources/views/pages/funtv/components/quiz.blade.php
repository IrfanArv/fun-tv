<div id="question-page">
    <img class="img-question img-blur img-fluid" id="img-quest" src="">
    <div class="trivia-timer trivia-timer px-5 py-3" id="countdown">
        <div class="row px-5">
            <div class="col d-flex justify-content-end p-0">
                <div id="minutes"></div>
            </div>
            <div class="col d-flex justify-content-start">
                <div id="seconds"></div>
            </div>
        </div>
    </div>
    <div class="question-card">
        <div class="question-title">
            <div class="py-4" id="quest_title"></div>
        </div>
        <div id="answers"></div>


        <div class="text-center text-muted mt-4" id="checking-answer" style="display:none">
            <div class="spinner-border spinner-border-sm mr-2 mb-1"></div>
            <p class="loading"> Loading</p>
        </div>
    </div>

</div>
<script type="text/javascript">
    var SITEURL = '{{ URL::to('') }}';

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function getAnswer(answer_id) {
        var questId = parseInt(event.target.dataset.quest);
        var PlayerId = '{{ $playerId }}'
        $(this).addClass("set");
        $("#checking-answer").show();
        $(".question-answer").addClass("inactive");
        var values = {
            'player': parseInt(PlayerId),
            'answer': answer_id,
            'quest': questId
        };
        $.ajax({
            type: "POST",
            url: SITEURL + "/questions" +"?_token=" + "{{ csrf_token() }}",
            dataType: "JSON",
            data: values,
            success: function(data) {
                if (data.status == true) {
                    $("#playerComponent").show();
                    rank_btn();
                    $("#homeComponent").show();
                    $("#quizComponent").hide();
                    $("#answers").html('');
                    $("#checking-answer").hide();
                } 
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    }
</script>
