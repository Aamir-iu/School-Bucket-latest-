<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Remarks For Students'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="remarksForStudents form large-9 medium-8 columns content">
    <?= $this->Form->create($remarksForStudent) ?>
    <fieldset>
        <legend><?= __('Add Remarks For Student') ?></legend>
        <?php
            echo $this->Form->input('registration_id');
            echo $this->Form->input('class_id');
            echo $this->Form->input('shift_id');
            echo $this->Form->input('Attitude');
            echo $this->Form->input('Behavior');
            echo $this->Form->input('Character');
            echo $this->Form->input('Communicationskills');
            echo $this->Form->input('Groupwork');
            echo $this->Form->input('interestsandtalents');
            echo $this->Form->input('participation');
            echo $this->Form->input('socialskills');
            echo $this->Form->input('timemanagement');
            echo $this->Form->input('workhabits');
            echo $this->Form->input('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
