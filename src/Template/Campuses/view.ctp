<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Campus'), ['action' => 'edit', $campus->id_campus]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Campus'), ['action' => 'delete', $campus->id_campus], ['confirm' => __('Are you sure you want to delete # {0}?', $campus->id_campus)]) ?> </li>
        <li><?= $this->Html->link(__('List Campuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Campus'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="campuses view large-9 medium-8 columns content">
    <h3><?= h($campus->id_campus) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Campus Name') ?></th>
            <td><?= h($campus->campus_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Campus Location') ?></th>
            <td><?= h($campus->campus_location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Campus Principle') ?></th>
            <td><?= h($campus->campus_principle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Campus Contact') ?></th>
            <td><?= h($campus->campus_contact) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Campus Contact2') ?></th>
            <td><?= h($campus->campus_contact2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Campus') ?></th>
            <td><?= $this->Number->format($campus->id_campus) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($campus->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($campus->created_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($campus->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Campus Id') ?></th>
                <th scope="col"><?= __('Full Name') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Phone1') ?></th>
                <th scope="col"><?= __('Phone2') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($campus->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->role_id) ?></td>
                <td><?= h($users->campus_id) ?></td>
                <td><?= h($users->full_name) ?></td>
                <td><?= h($users->Address) ?></td>
                <td><?= h($users->phone1) ?></td>
                <td><?= h($users->phone2) ?></td>
                <td><?= h($users->image) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
