<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Remarks For Student'), ['action' => 'edit', $remarksForStudent->id_remarks_for_students]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Remarks For Student'), ['action' => 'delete', $remarksForStudent->id_remarks_for_students], ['confirm' => __('Are you sure you want to delete # {0}?', $remarksForStudent->id_remarks_for_students)]) ?> </li>
        <li><?= $this->Html->link(__('List Remarks For Students'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Remarks For Student'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="remarksForStudents view large-9 medium-8 columns content">
    <h3><?= h($remarksForStudent->id_remarks_for_students) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id Remarks For Students') ?></th>
            <td><?= $this->Number->format($remarksForStudent->id_remarks_for_students) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Registration Id') ?></th>
            <td><?= $this->Number->format($remarksForStudent->registration_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class Id') ?></th>
            <td><?= $this->Number->format($remarksForStudent->class_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shift Id') ?></th>
            <td><?= $this->Number->format($remarksForStudent->shift_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attitude') ?></th>
            <td><?= $this->Number->format($remarksForStudent->Attitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Behavior') ?></th>
            <td><?= $this->Number->format($remarksForStudent->Behavior) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Character') ?></th>
            <td><?= $this->Number->format($remarksForStudent->Character) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Communicationskills') ?></th>
            <td><?= $this->Number->format($remarksForStudent->Communicationskills) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Groupwork') ?></th>
            <td><?= $this->Number->format($remarksForStudent->Groupwork) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Interestsandtalents') ?></th>
            <td><?= $this->Number->format($remarksForStudent->interestsandtalents) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Participation') ?></th>
            <td><?= $this->Number->format($remarksForStudent->participation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Socialskills') ?></th>
            <td><?= $this->Number->format($remarksForStudent->socialskills) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Timemanagement') ?></th>
            <td><?= $this->Number->format($remarksForStudent->timemanagement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Workhabits') ?></th>
            <td><?= $this->Number->format($remarksForStudent->workhabits) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= $this->Number->format($remarksForStudent->date) ?></td>
        </tr>
    </table>
</div>
