<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $usersRoleManagement->id_menu_user_role],
                ['confirm' => __('Are you sure you want to delete # {0}?', $usersRoleManagement->id_menu_user_role)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users Role Management'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersRoleManagement form large-9 medium-8 columns content">
    <?= $this->Form->create($usersRoleManagement) ?>
    <fieldset>
        <legend><?= __('Edit Users Role Management') ?></legend>
        <?php
            echo $this->Form->input('role_id', ['options' => $roles, 'empty' => true]);
            echo $this->Form->input('main_menu_id');
            echo $this->Form->input('sub_mneu_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
