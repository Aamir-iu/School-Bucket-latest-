<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id_products]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id_products], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id_products)]) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="products view large-9 medium-8 columns content">
    <h3><?= h($product->id_products) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Product Name') ?></th>
            <td><?= h($product->product_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Active') ?></th>
            <td><?= h($product->product_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sku') ?></th>
            <td><?= h($product->sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Products') ?></th>
            <td><?= $this->Number->format($product->id_products) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Type') ?></th>
            <td><?= $this->Number->format($product->product_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expiry Months') ?></th>
            <td><?= $this->Number->format($product->expiry_months) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Product Desc') ?></h4>
        <?= $this->Text->autoParagraph(h($product->product_desc)); ?>
    </div>
</div>
