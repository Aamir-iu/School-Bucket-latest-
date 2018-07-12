<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Room Master'), ['action' => 'edit', $roomMaster->id_room_master]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Room Master'), ['action' => 'delete', $roomMaster->id_room_master], ['confirm' => __('Are you sure you want to delete # {0}?', $roomMaster->id_room_master)]) ?> </li>
        <li><?= $this->Html->link(__('List Room Master'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Room Master'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="roomMaster view large-9 medium-8 columns content">
    <h3><?= h($roomMaster->id_room_master) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Room Name') ?></th>
            <td><?= h($roomMaster->room_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Room Desc') ?></th>
            <td><?= h($roomMaster->room_desc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Room Master') ?></th>
            <td><?= $this->Number->format($roomMaster->id_room_master) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= $this->Number->format($roomMaster->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($roomMaster->created_by) ?></td>
        </tr>
    </table>
</div>
