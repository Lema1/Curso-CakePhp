<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h2>Usuarios</h2>
        </div>
        <div class="table-reponsive">
            <table class="table table-strped table-hover">
            <thead>
                <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('first_name', ['Nombre']) ?></th>
                <th><?= $this->Paginator->sort('last_name', ['Apellidos']) ?></th>
                <th><?= $this->Paginator->sort('email', ['Correo Electronico']) ?></th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Number->format($user->id) ?></td>
                    <td><?= h($user->first_name) ?></td>
                    <td><?= h($user->last_name) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td>
                        <?= $this->Html->link('Ver', ['action' => 'view', $user->id], ['class' => 'btn btn-sm btn-info']) ?>
                        <?= $this->Html->link('Editar', ['action' => 'edit', $user->id], ['class' => 'btn btn-sm btn-primary']) ?>
                        <?= $this->Form->postLink('Borrar', ['action' => 'delete', $user->id], ['confirm' => 'Eliminar Usuario ?', 'class' => 'btn btn-sm btn-danger']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
        </div>

        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< Anterior') ?>
                <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                <?= $this->Paginator->next('Siguiente >') ?>
                <?= $this->Paginator->last('Ultima >>') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>