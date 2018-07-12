<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Business Partners'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="businessPartners form large-9 medium-8 columns content">
    <?= $this->Form->create($businessPartner) ?>
    <fieldset>
        <legend><?= __('Add Business Partner') ?></legend>
        <?php
            echo $this->Form->input('business_type');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
            echo $this->Form->input('related_table');
            echo $this->Form->input('related_table_id');
            echo $this->Form->input('related_table_field');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
