<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit General Setting'), ['action' => 'edit', $generalSetting->id_general_setting]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete General Setting'), ['action' => 'delete', $generalSetting->id_general_setting], ['confirm' => __('Are you sure you want to delete # {0}?', $generalSetting->id_general_setting)]) ?> </li>
        <li><?= $this->Html->link(__('List General Setting'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New General Setting'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="generalSetting view large-9 medium-8 columns content">
    <h3><?= h($generalSetting->id_general_setting) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Institution Name') ?></th>
            <td><?= h($generalSetting->Institution_Name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Institution Address') ?></th>
            <td><?= h($generalSetting->Institution_Address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Institution Email') ?></th>
            <td><?= h($generalSetting->Institution_Email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Institution Phone') ?></th>
            <td><?= h($generalSetting->Institution_Phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Institution Mobile') ?></th>
            <td><?= h($generalSetting->Institution_Mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Institution Fax') ?></th>
            <td><?= h($generalSetting->Institution_Fax) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admin Contact Person') ?></th>
            <td><?= h($generalSetting->Admin_Contact_Person) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Language') ?></th>
            <td><?= h($generalSetting->Language) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Timezone') ?></th>
            <td><?= h($generalSetting->Timezone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Logo') ?></th>
            <td><?= h($generalSetting->logo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id General Setting') ?></th>
            <td><?= $this->Number->format($generalSetting->id_general_setting) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= $this->Number->format($generalSetting->Country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency Type') ?></th>
            <td><?= $this->Number->format($generalSetting->Currency_Type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($generalSetting->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($generalSetting->created_on) ?></td>
        </tr>
    </table>
</div>
