<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Po Grn Detail'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="poGrnDetail index large-9 medium-8 columns content">
    <h3><?= __('Po Grn Detail') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id_po_grn_detail') ?></th>
                <th scope="col"><?= $this->Paginator->sort('po_grn_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grn_product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grn_product_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('received_pack_qty') ?></th>
                <th scope="col"><?= $this->Paginator->sort('received_units_per_pack') ?></th>
                <th scope="col"><?= $this->Paginator->sort('received_pack_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('received_unit_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($poGrnDetail as $poGrnDetail): ?>
            <tr>
                <td><?= $this->Number->format($poGrnDetail->id_po_grn_detail) ?></td>
                <td><?= $this->Number->format($poGrnDetail->po_grn_id) ?></td>
                <td><?= $this->Number->format($poGrnDetail->grn_product_id) ?></td>
                <td><?= h($poGrnDetail->grn_product_name) ?></td>
                <td><?= $this->Number->format($poGrnDetail->received_pack_qty) ?></td>
                <td><?= $this->Number->format($poGrnDetail->received_units_per_pack) ?></td>
                <td><?= $this->Number->format($poGrnDetail->received_pack_price) ?></td>
                <td><?= $this->Number->format($poGrnDetail->received_unit_price) ?></td>
                <td><?= h($poGrnDetail->created_on) ?></td>
                <td><?= $this->Number->format($poGrnDetail->created_by) ?></td>
                <td class="actions">
                    
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $poGrnDetail->id_po_grn_detail]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $poGrnDetail->id_po_grn_detail], ['confirm' => __('Are you sure you want to delete # {0}?', $poGrnDetail->id_po_grn_detail)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
