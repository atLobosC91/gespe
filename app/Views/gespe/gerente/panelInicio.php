<h1>Bienvenido, <?= esc($usuario['nombres']) ?> <?= esc($usuario['apellidos']) ?></h1>
<p>Tu rol es: <?= esc($usuario['id_rol']) == 1 ? 'Gerente' : 'Otro rol' ?></p>
