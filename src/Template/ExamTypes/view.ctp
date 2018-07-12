<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Exam Type'), ['action' => 'edit', $examType->id_exam_types]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Exam Type'), ['action' => 'delete', $examType->id_exam_types], ['confirm' => __('Are you sure you want to delete # {0}?', $examType->id_exam_types)]) ?> </li>
        <li><?= $this->Html->link(__('List Exam Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exam Marks Details'), ['controller' => 'ExamMarksDetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam Marks Detail'), ['controller' => 'ExamMarksDetails', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exam Result Go'), ['controller' => 'ExamResultGo', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam Result Go'), ['controller' => 'ExamResultGo', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exam Results'), ['controller' => 'ExamResults', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exam Result'), ['controller' => 'ExamResults', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="examTypes view large-9 medium-8 columns content">
    <h3><?= h($examType->id_exam_types) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Exam Type') ?></th>
            <td><?= h($examType->exam_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Exam Types') ?></th>
            <td><?= $this->Number->format($examType->id_exam_types) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Exam Marks Details') ?></h4>
        <?php if (!empty($examType->exam_marks_details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id Marks Detail') ?></th>
                <th scope="col"><?= __('Class Id') ?></th>
                <th scope="col"><?= __('Subject Id') ?></th>
                <th scope="col"><?= __('Exam Type Id') ?></th>
                <th scope="col"><?= __('Min Marks') ?></th>
                <th scope="col"><?= __('Max Marks') ?></th>
                <th scope="col"><?= __('Order Id') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($examType->exam_marks_details as $examMarksDetails): ?>
            <tr>
                <td><?= h($examMarksDetails->id_marks_detail) ?></td>
                <td><?= h($examMarksDetails->class_id) ?></td>
                <td><?= h($examMarksDetails->subject_id) ?></td>
                <td><?= h($examMarksDetails->exam_type_id) ?></td>
                <td><?= h($examMarksDetails->min_marks) ?></td>
                <td><?= h($examMarksDetails->max_marks) ?></td>
                <td><?= h($examMarksDetails->order_id) ?></td>
                <td><?= h($examMarksDetails->created_on) ?></td>
                <td><?= h($examMarksDetails->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ExamMarksDetails', 'action' => 'view', $examMarksDetails->id_marks_detail]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ExamMarksDetails', 'action' => 'edit', $examMarksDetails->id_marks_detail]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ExamMarksDetails', 'action' => 'delete', $examMarksDetails->id_marks_detail], ['confirm' => __('Are you sure you want to delete # {0}?', $examMarksDetails->id_marks_detail)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Exam Result Go') ?></h4>
        <?php if (!empty($examType->exam_result_go)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id Go') ?></th>
                <th scope="col"><?= __('Registration Id') ?></th>
                <th scope="col"><?= __('Session Id') ?></th>
                <th scope="col"><?= __('Exam Type Id') ?></th>
                <th scope="col"><?= __('Home Work') ?></th>
                <th scope="col"><?= __('Reading') ?></th>
                <th scope="col"><?= __('Writing') ?></th>
                <th scope="col"><?= __('Cleanliiness') ?></th>
                <th scope="col"><?= __('Sv') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($examType->exam_result_go as $examResultGo): ?>
            <tr>
                <td><?= h($examResultGo->id_go) ?></td>
                <td><?= h($examResultGo->registration_id) ?></td>
                <td><?= h($examResultGo->session_id) ?></td>
                <td><?= h($examResultGo->exam_type_id) ?></td>
                <td><?= h($examResultGo->home_work) ?></td>
                <td><?= h($examResultGo->reading) ?></td>
                <td><?= h($examResultGo->writing) ?></td>
                <td><?= h($examResultGo->cleanliiness) ?></td>
                <td><?= h($examResultGo->sv) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ExamResultGo', 'action' => 'view', $examResultGo->id_go]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ExamResultGo', 'action' => 'edit', $examResultGo->id_go]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ExamResultGo', 'action' => 'delete', $examResultGo->id_go], ['confirm' => __('Are you sure you want to delete # {0}?', $examResultGo->id_go)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Exam Results') ?></h4>
        <?php if (!empty($examType->exam_results)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id Exam') ?></th>
                <th scope="col"><?= __('Registration Id') ?></th>
                <th scope="col"><?= __('Class Id') ?></th>
                <th scope="col"><?= __('Shift Id') ?></th>
                <th scope="col"><?= __('Exam Type Id') ?></th>
                <th scope="col"><?= __('Session Id') ?></th>
                <th scope="col"><?= __('Total Marks') ?></th>
                <th scope="col"><?= __('Obtain Marks') ?></th>
                <th scope="col"><?= __('Per') ?></th>
                <th scope="col"><?= __('Grade') ?></th>
                <th scope="col"><?= __('Rank') ?></th>
                <th scope="col"><?= __('Result') ?></th>
                <th scope="col"><?= __('Remarks') ?></th>
                <th scope="col"><?= __('No Of Rank') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Att') ?></th>
                <th scope="col"><?= __('Out Of') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($examType->exam_results as $examResults): ?>
            <tr>
                <td><?= h($examResults->id_exam) ?></td>
                <td><?= h($examResults->registration_id) ?></td>
                <td><?= h($examResults->class_id) ?></td>
                <td><?= h($examResults->shift_id) ?></td>
                <td><?= h($examResults->exam_type_id) ?></td>
                <td><?= h($examResults->session_id) ?></td>
                <td><?= h($examResults->total_marks) ?></td>
                <td><?= h($examResults->obtain_marks) ?></td>
                <td><?= h($examResults->per) ?></td>
                <td><?= h($examResults->grade) ?></td>
                <td><?= h($examResults->rank) ?></td>
                <td><?= h($examResults->result) ?></td>
                <td><?= h($examResults->remarks) ?></td>
                <td><?= h($examResults->no_of_rank) ?></td>
                <td><?= h($examResults->created_on) ?></td>
                <td><?= h($examResults->created_by) ?></td>
                <td><?= h($examResults->att) ?></td>
                <td><?= h($examResults->out_of) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ExamResults', 'action' => 'view', $examResults->id_exam]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ExamResults', 'action' => 'edit', $examResults->id_exam]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ExamResults', 'action' => 'delete', $examResults->id_exam], ['confirm' => __('Are you sure you want to delete # {0}?', $examResults->id_exam)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
