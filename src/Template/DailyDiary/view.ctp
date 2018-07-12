<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Daily Diary'), ['action' => 'edit', $dailyDiary->id_daily_diary]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Daily Diary'), ['action' => 'delete', $dailyDiary->id_daily_diary], ['confirm' => __('Are you sure you want to delete # {0}?', $dailyDiary->id_daily_diary)]) ?> </li>
        <li><?= $this->Html->link(__('List Daily Diary'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Daily Diary'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dailyDiary view large-9 medium-8 columns content">
    <h3><?= h($dailyDiary->id_daily_diary) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id Daily Diary') ?></th>
            <td><?= $this->Number->format($dailyDiary->id_daily_diary) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class Id') ?></th>
            <td><?= $this->Number->format($dailyDiary->class_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shift Id') ?></th>
            <td><?= $this->Number->format($dailyDiary->shift_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($dailyDiary->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($dailyDiary->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($dailyDiary->created_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Desc') ?></h4>
        <?= $this->Text->autoParagraph(h($dailyDiary->desc)); ?>
    </div>
    <div class="row">
        <h4><?= __('Addiotion') ?></h4>
        <?= $this->Text->autoParagraph(h($dailyDiary->addiotion)); ?>
    </div>
</div>
