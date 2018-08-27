<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->employee_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->employee_id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->employee_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employees view large-9 medium-8 columns content">
    <h3><?= h($employee->employee_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $employee->has('employee') ? $this->Html->link($employee->employee->employee_id, ['controller' => 'Employees', 'action' => 'view', $employee->employee->employee_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $employee->has('user') ? $this->Html->link($employee->user->id, ['controller' => 'Users', 'action' => 'view', $employee->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee Name') ?></th>
            <td><?= h($employee->employee_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee Address') ?></th>
            <td><?= h($employee->employee_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee No') ?></th>
            <td><?= h($employee->employee_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee Email') ?></th>
            <td><?= h($employee->employee_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee Phone1') ?></th>
            <td><?= h($employee->employee_phone1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee Phone2') ?></th>
            <td><?= h($employee->employee_phone2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee Phone2') ?></th>
            <td><?= h($employee->employee_qualification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee Pic') ?></th>
            <td><?= h($employee->employee_pic) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee Created By') ?></th>
            <td><?= $this->Number->format($employee->employee_created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee Created On') ?></th>
            <td><?= h($employee->employee_created_on) ?></td>
        </tr>
    </table>
</div>
