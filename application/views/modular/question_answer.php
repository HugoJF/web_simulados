<?php
$decoded_answers = json_decode($question->answers, TRUE);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-right">
            <button type="button" class="btn btn-default" aria-label="Left Align">
                <span class="glyphicon glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
            </button>
            <button type="button" class="btn btn-default" aria-label="Left Align">
                <span class="glyphicon glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
            </button>
        </div>
        <h4><?php echo $question->question; ?></h4>
    </div>
    <div class="panel-body">
        <div class="pull-right" id="details">
            <?php foreach ($categories as $category): ?>
                <span class="label label-primary"><?php echo $category->category_name; ?></span>
            <?php endforeach; ?>
            <em>
                <small>Sent by:
                    <strong><?php echo $this->ion_auth->user($question->author)->result()[0]->first_name; ?></strong>
                    scoring: <?php echo $question->teacher_votes . '+' . $question->student_votes; ?></small>
            </em>
        </div>
        <div class="btn-group-vertical" data-toggle="buttons">
            <?php foreach ($decoded_answers as $letter => $answer): ?>
                <label class="btn <?php if($question->correct_answer == $letter) { echo 'btn-success active'; } else { echo 'btn-default'; }?>">
                    <input type="radio" name="question-id-<?php echo $question->id; ?>" value="<?php echo $letter; ?>" autocomplete="off"> <?php echo $letter . ') ' . $answer ?>
                </label>
            <?php endforeach; ?>
        </div>
        <input type="hidden" name="answer" value="<?php echo $letter; ?>">
    </div>
</div>
