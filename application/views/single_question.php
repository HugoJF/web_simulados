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
        <p><?php foreach($decoded_answers as $letter=>$answer): ?></p>
                <form method="post" action="<?php echo base_url('questions/answer/'.$question->id.'/'); ?>/" style="display:inline"><button type="submit" class="btn btn-default"><?php echo $letter; ?>) <?php echo $answer; ?></button><input type="hidden" name="answer" value="<?php echo $letter; ?>"></form>
        <?php endforeach; ?>
    </div>
</div>
