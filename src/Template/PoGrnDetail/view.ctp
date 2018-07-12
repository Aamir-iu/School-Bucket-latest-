<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Po Grn Detail'), ['action' => 'edit', $poGrnDetail->id_po_grn_detail]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Po Grn Detail'), ['action' => 'delete', $poGrnDetail->id_po_grn_detail], ['confirm' => __('Are you sure you want to delete # {0}?', $poGrnDetail->id_po_grn_detail)]) ?> </li>
        <li><?= $this->Html->link(__('List Po Grn Detail'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Po Grn Detail'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="poGrnDetail view large-9 medium-8 columns content">
    <h3><?= h($poGrnDetail->id_po_grn_detail) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Grn Product Name') ?></th>
            <td><?= h($poGrnDetail->grn_product_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Po Grn Detail') ?></th>
            <td><?= $this->Number->format($poGrnDetail->id_po_grn_detail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Po Grn Id') ?></th>
            <td><?= $this->Number->format($poGrnDetail->po_grn_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grn Product Id') ?></th>
            <td><?= $this->Number->format($poGrnDetail->grn_product_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Received Pack Qty') ?></th>
            <td><?= $this->Number->format($poGrnDetail->received_pack_qty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Received Units Per Pack') ?></th>
            <td><?= $this->Number->format($poGrnDetail->received_units_per_pack) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Received Pack Price') ?></th>
            <td><?= $this->Number->format($poGrnDetail->received_pack_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Received Unit Price') ?></th>
            <td><?= $this->Number->format($poGrnDetail->received_unit_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($poGrnDetail->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($poGrnDetail->created_on) ?></td>
        </tr>
    </table>
</div>
