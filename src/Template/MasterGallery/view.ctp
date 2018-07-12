<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Master Gallery'), ['action' => 'edit', $masterGallery->id_master_gallery]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Master Gallery'), ['action' => 'delete', $masterGallery->id_master_gallery], ['confirm' => __('Are you sure you want to delete # {0}?', $masterGallery->id_master_gallery)]) ?> </li>
        <li><?= $this->Html->link(__('List Master Gallery'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Master Gallery'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Gallery Details'), ['controller' => 'GalleryDetails', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gallery Detail'), ['controller' => 'GalleryDetails', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="masterGallery view large-9 medium-8 columns content">
    <h3><?= h($masterGallery->id_master_gallery) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Desc') ?></th>
            <td><?= h($masterGallery->desc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Master Gallery') ?></th>
            <td><?= $this->Number->format($masterGallery->id_master_gallery) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Gallery Details') ?></h4>
        <?php if (!empty($masterGallery->gallery_details)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id Gallery Details') ?></th>
                <th scope="col"><?= __('Master Gallery Id') ?></th>
                <th scope="col"><?= __('Pic') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($masterGallery->gallery_details as $galleryDetails): ?>
            <tr>
                <td><?= h($galleryDetails->id_gallery_details) ?></td>
                <td><?= h($galleryDetails->master_gallery_id) ?></td>
                <td><?= h($galleryDetails->pic) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'GalleryDetails', 'action' => 'view', $galleryDetails->id_gallery_details]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'GalleryDetails', 'action' => 'edit', $galleryDetails->id_gallery_details]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'GalleryDetails', 'action' => 'delete', $galleryDetails->id_gallery_details], ['confirm' => __('Are you sure you want to delete # {0}?', $galleryDetails->id_gallery_details)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
