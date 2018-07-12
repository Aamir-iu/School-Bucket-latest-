<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->department_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->department_id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->department_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departments view large-9 medium-8 columns content">
    <h3><?= h($department->department_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $department->has('department') ? $this->Html->link($department->department->department_id, ['controller' => 'Departments', 'action' => 'view', $department->department->department_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department Name') ?></th>
            <td><?= h($department->department_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department Manager') ?></th>
            <td><?= $this->Number->format($department->department_manager) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department Created By') ?></th>
            <td><?= $this->Number->format($department->department_created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department Created On') ?></th>
            <td><?= h($department->department_created_on) ?></td>
        </tr>
    </table>
</div>
