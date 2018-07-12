<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $studentAttendance->id_attendance],
                ['confirm' => __('Are you sure you want to delete # {0}?', $studentAttendance->id_attendance)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Student Attendance'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Campuses'), ['controller' => 'Campuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Campus'), ['controller' => 'Campuses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="studentAttendance form large-9 medium-8 columns content">
    <?= $this->Form->create($studentAttendance) ?>
    <fieldset>
        <legend><?= __('Edit Student Attendance') ?></legend>
        <?php
            echo $this->Form->input('registration_id');
            echo $this->Form->input('class_id');
            echo $this->Form->input('shift_id');
            echo $this->Form->input('campus_id', ['options' => $campuses, 'empty' => true]);
            echo $this->Form->input('status');
            echo $this->Form->input('attendace_date', ['empty' => true]);
            echo $this->Form->input('created_by');
            echo $this->Form->input('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
