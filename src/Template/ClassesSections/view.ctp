<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Classes Section'), ['action' => 'edit', $classesSection->id_class]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Classes Section'), ['action' => 'delete', $classesSection->id_class], ['confirm' => __('Are you sure you want to delete # {0}?', $classesSection->id_class)]) ?> </li>
        <li><?= $this->Html->link(__('List Classes Sections'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Classes Section'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="classesSections view large-9 medium-8 columns content">
    <h3><?= h($classesSection->id_class) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Class Name') ?></th>
            <td><?= h($classesSection->class_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Class') ?></th>
            <td><?= $this->Number->format($classesSection->id_class) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($classesSection->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($classesSection->created_on) ?></td>
        </tr>
    </table>
</div>
