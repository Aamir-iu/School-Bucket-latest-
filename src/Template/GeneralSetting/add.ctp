<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List General Setting'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="generalSetting form large-9 medium-8 columns content">
    <?= $this->Form->create($generalSetting) ?>
    <fieldset>
        <legend><?= __('Add General Setting') ?></legend>
        <?php
            echo $this->Form->input('Institution_Name');
            echo $this->Form->input('Institution_Address');
            echo $this->Form->input('Institution_Email');
            echo $this->Form->input('Institution_Phone');
            echo $this->Form->input('Institution_Mobile');
            echo $this->Form->input('Institution_Fax');
            echo $this->Form->input('Admin_Contact_Person');
            echo $this->Form->input('Country');
            echo $this->Form->input('Currency_Type');
            echo $this->Form->input('Language');
            echo $this->Form->input('Timezone');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
            echo $this->Form->input('logo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
