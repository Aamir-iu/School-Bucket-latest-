<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Role Management'), ['action' => 'edit', $usersRoleManagement->id_menu_user_role]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Role Management'), ['action' => 'delete', $usersRoleManagement->id_menu_user_role], ['confirm' => __('Are you sure you want to delete # {0}?', $usersRoleManagement->id_menu_user_role)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Role Management'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Role Management'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersRoleManagement view large-9 medium-8 columns content">
    <h3><?= h($usersRoleManagement->id_menu_user_role) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $usersRoleManagement->has('role') ? $this->Html->link($usersRoleManagement->role->id_roles, ['controller' => 'Roles', 'action' => 'view', $usersRoleManagement->role->id_roles]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Menu User Role') ?></th>
            <td><?= $this->Number->format($usersRoleManagement->id_menu_user_role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Main Menu Id') ?></th>
            <td><?= $this->Number->format($usersRoleManagement->main_menu_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sub Mneu Id') ?></th>
            <td><?= $this->Number->format($usersRoleManagement->sub_mneu_id) ?></td>
        </tr>
    </table>
</div>
