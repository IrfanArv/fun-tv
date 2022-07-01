<div id="question-page">
    <div class="trivia-timer trivia-timer px-5 py-3" id="countdown">
        <div class="row px-5">
            <div class="col d-flex justify-content-end">
                <div id="minutes"></div>
            </div>
            <div class="col d-flex justify-content-start">
                <div id="seconds"></div>
            </div>
        </div>
    </div>
    <div class="question-card">
        <div class="question-title">
            {{-- <?php if ($question->image != NULL || $question->image != "") { ?>
            <img style="width:200px" src="<?php echo base_url('assets/img/games/trivia/' . $question->image); ?>" alt="" class="mb-3  img-question img-blur" /><br>
            <?php } ?> --}}
            <div class="py-4" id="quest_title"></div>
        </div>
        <div id="answers"></div>


        {{-- <?php foreach ($question_detail as $qd) { ?>
        <div class="question-answer" answer-id="<?php echo $qd->id; ?>">
            <?php echo $qd->answer_choice; ?>
        </div>
        <?php } ?>

        <div class="text-center text-muted mt-4" id="checking-answer" style="display:none">
            <div class="spinner-border spinner-border-sm mr-2 mb-1"></div>Loading...
        </div> --}}
    </div>

</div>
