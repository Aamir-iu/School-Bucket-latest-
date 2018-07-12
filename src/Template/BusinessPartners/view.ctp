<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Business Partner'), ['action' => 'edit', $businessPartner->id_business_type]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Business Partner'), ['action' => 'delete', $businessPartner->id_business_type], ['confirm' => __('Are you sure you want to delete # {0}?', $businessPartner->id_business_type)]) ?> </li>
        <li><?= $this->Html->link(__('List Business Partners'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Business Partner'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="businessPartners view large-9 medium-8 columns content">
    <h3><?= h($businessPartner->id_business_type) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Business Type') ?></th>
            <td><?= h($businessPartner->business_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Related Table') ?></th>
            <td><?= h($businessPartner->related_table) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Related Table Id') ?></th>
            <td><?= h($businessPartner->related_table_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Related Table Field') ?></th>
            <td><?= h($businessPartner->related_table_field) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Business Type') ?></th>
            <td><?= $this->Number->format($businessPartner->id_business_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($businessPartner->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($businessPartner->created_on) ?></td>
        </tr>
    </table>
</div>
