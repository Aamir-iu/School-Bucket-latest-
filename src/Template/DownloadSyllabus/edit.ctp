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
                ['action' => 'delete', $downloadSyllabus->id_download_syllabus],
                ['confirm' => __('Are you sure you want to delete # {0}?', $downloadSyllabus->id_download_syllabus)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Download Syllabus'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="downloadSyllabus form large-9 medium-8 columns content">
    <?= $this->Form->create($downloadSyllabus) ?>
    <fieldset>
        <legend><?= __('Edit Download Syllabus') ?></legend>
        <?php
            echo $this->Form->input('registration_id');
            echo $this->Form->input('class_id');
            echo $this->Form->input('shift_id');
            echo $this->Form->input('description');
            echo $this->Form->input('download');
            echo $this->Form->input('date', ['empty' => true]);
            echo $this->Form->input('created_by');
            echo $this->Form->input('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
