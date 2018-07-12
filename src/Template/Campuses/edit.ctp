<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $campus->id_campus],
                ['confirm' => __('Are you sure you want to delete # {0}?', $campus->id_campus)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Campuses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="campuses form large-9 medium-8 columns content">
    <?= $this->Form->create($campus) ?>
    <fieldset>
        <legend><?= __('Edit Campus') ?></legend>
        <?php
            echo $this->Form->input('campus_name');
            echo $this->Form->input('campus_location');
            echo $this->Form->input('campus_principle');
            echo $this->Form->input('campus_contact');
            echo $this->Form->input('campus_contact2');
            echo $this->Form->input('created_by');
            echo $this->Form->input('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
