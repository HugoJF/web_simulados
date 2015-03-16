<?php
$decoded_answers = json_decode($question->answers, TRUE);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?php echo $question->question; ?></h4>
    </div>
    <div class="panel-body">
        <div class="pull-right" id="details">
            <?php foreach ($categories as $category): ?>
                <span class="label label-primary"><?php echo $category->category_name; ?></span>
            <?php endforeach; ?>
            <em><small>Sent by: <strong><?php echo $this->ion_auth->user($question->author)->result()[0]->first_name; ?></strong> scoring: <?php echo $question->teacher_votes.'+'.$question->student_votes; ?></small></em>
        </div>
        <h4><?php if($this->input->post('answer') == $question->correct_answer) { echo 'Correct!'; } else { echo 'Wrong answer'; } ?></h4>
        <p><?php foreach($decoded_answers as $letter=>$answer): ?></p>
       <button type="submit" class="btn <?php if($letter == $question->correct_answer) { echo 'btn-success'; } else if ($letter == $this->input->post('answer')) { echo 'btn-danger'; }; ?> btn-default"><?php echo $letter; ?>) <?php echo $answer; ?></button>
        <?php endforeach; ?>
    </div>
</div>