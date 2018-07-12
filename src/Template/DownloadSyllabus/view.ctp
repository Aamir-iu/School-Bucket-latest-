<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Download Syllabus'), ['action' => 'edit', $downloadSyllabus->id_download_syllabus]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Download Syllabus'), ['action' => 'delete', $downloadSyllabus->id_download_syllabus], ['confirm' => __('Are you sure you want to delete # {0}?', $downloadSyllabus->id_download_syllabus)]) ?> </li>
        <li><?= $this->Html->link(__('List Download Syllabus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Download Syllabus'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="downloadSyllabus view large-9 medium-8 columns content">
    <h3><?= h($downloadSyllabus->id_download_syllabus) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($downloadSyllabus->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Download') ?></th>
            <td><?= h($downloadSyllabus->download) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Download Syllabus') ?></th>
            <td><?= $this->Number->format($downloadSyllabus->id_download_syllabus) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Registration Id') ?></th>
            <td><?= $this->Number->format($downloadSyllabus->registration_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class Id') ?></th>
            <td><?= $this->Number->format($downloadSyllabus->class_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shift Id') ?></th>
            <td><?= $this->Number->format($downloadSyllabus->shift_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($downloadSyllabus->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($downloadSyllabus->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($downloadSyllabus->created_on) ?></td>
        </tr>
    </table>
</div>
