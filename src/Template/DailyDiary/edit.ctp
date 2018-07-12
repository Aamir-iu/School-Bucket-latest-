<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dailyDiary->id_daily_diary],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dailyDiary->id_daily_diary)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Daily Diary'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="dailyDiary form large-9 medium-8 columns content">
    <?= $this->Form->create($dailyDiary) ?>
    <fieldset>
        <legend><?= __('Edit Daily Diary') ?></legend>
        <?php
            echo $this->Form->input('desc');
            echo $this->Form->input('addiotion');
            echo $this->Form->input('class_id');
            echo $this->Form->input('shift_id');
            echo $this->Form->input('date', ['empty' => true]);
            echo $this->Form->input('created_by');
            echo $this->Form->input('created_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
