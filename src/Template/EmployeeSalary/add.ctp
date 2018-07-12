<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Employee Salary'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="employeeSalary form large-9 medium-8 columns content">
    <?= $this->Form->create($employeeSalary) ?>
    <fieldset>
        <legend><?= __('Add Employee Salary') ?></legend>
        <?php
            echo $this->Form->input('employee_id', ['options' => $employees, 'empty' => true]);
            echo $this->Form->input('basic_salary');
            echo $this->Form->input('working_days');
            echo $this->Form->input('per_day_salary');
            echo $this->Form->input('extra_amount');
            echo $this->Form->input('late');
            echo $this->Form->input('absents');
            echo $this->Form->input('detect_salary');
            echo $this->Form->input('installment');
            echo $this->Form->input('gross_salary');
            echo $this->Form->input('PFA');
            echo $this->Form->input('Net_salary');
            echo $this->Form->input('salary_month');
            echo $this->Form->input('salary_year');
            echo $this->Form->input('salary_date', ['empty' => true]);
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
