<?php
    echo $this->Form->control('first_name', ['label' => 'Nombre']);
    echo $this->Form->control('last_name', ['label' => 'Apellido']);
    echo $this->Form->control('email', ['label' => 'Correo Electronico']);
    echo $this->Form->control('password', ['label' => 'Contraseña', 'value' => '']);
?>