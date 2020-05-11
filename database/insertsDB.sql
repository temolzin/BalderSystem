INSERT INTO genero values(
    1,
    'Hombre'
);
INSERT INTO genero values(
    2,
    'Mujer'
);

INSERT INTO tipousuario values(
    1,
    'Administrador'
);
INSERT INTO tipousuario values(
    2,
    'CreadorContenido'
);
INSERT INTO tipousuario values(
    3,
    'Verificador'
);
INSERT INTO usuario values(
    null,
    1,
    'temolzin',
    'root',
    'Temolzin Itzae',
    'Roldan',
    'Palacios',
    'temolzin@hotmail.com',
    '5535092965',
    'foto.png',
    1
);

INSERT INTO institucionbancaria VALUES (
    1,
    'SIN ASIGNAR',
    'No Aplica'
);
INSERT INTO institucionbancaria VALUES (
    2,
    'BANAMEX',
    'Banco Nacional de México S.A'
);
INSERT INTO institucionbancaria VALUES (
    3,
    'BBVA',
    'Grupo Financiero BBVA Bancomer'
);
INSERT INTO institucionbancaria VALUES (
    4,
    'SANTANDER',
    'Grupo Financiero Santander'
);
INSERT INTO institucionbancaria VALUES (
    5,
    'HSBC',
    'Grupo Financiero HSBC'
);
INSERT INTO institucionbancaria VALUES (
    6,
    'SCOTIABANK',
    'Scotiabank Inverlat, S.A'
);
INSERT INTO institucionbancaria VALUES (
    7,
    'BANORTE',
    'Grupo Financiero Banorte'
);
INSERT INTO institucionbancaria VALUES (
    8,
    'BANCO AZTECA',
    'Banco Azteca, S.A'
);
INSERT INTO institucionbancaria VALUES (
    9,
    'BANJERCITO',
    'Fuerza Aérea y Armada, Sociedad Nacional de Crédito'
);

INSERT INTO modulo VALUES(
    1,
    'Pensión',
    'Módulo de pensiones',
    1
);
INSERT INTO modulo VALUES(
    2,
    'Préstamo',
    'Módulo de préstamos',
    1
);

INSERT INTO tipoconceptotransaccion VALUES(
    1,
    'Cargo',
    '-',
    'Cargos para los clientes',
    1
);
INSERT INTO tipoconceptotransaccion VALUES(
    2,
    'Abono',
    '+',
    'Abono para los clientes',
    1
);

INSERT INTO moduloprivilegiousuario VALUES (
    1,
    'Modulo'
);
INSERT INTO moduloprivilegiousuario VALUES (
    2,
    'Inicio'
);
INSERT INTO moduloprivilegiousuario VALUES (
    3,
    'Cliente'
);
INSERT INTO moduloprivilegiousuario VALUES (
    4,
    'Transaccion'
);
INSERT INTO moduloprivilegiousuario VALUES (
    5,
    'Reporte'
);
INSERT INTO moduloprivilegiousuario VALUES (
    6,
    'Documento'
);
INSERT INTO moduloprivilegiousuario VALUES (
    7,
    'Concepto'
);
INSERT INTO moduloprivilegiousuario VALUES (
    8,
    'Usuario'
);
INSERT INTO moduloprivilegiousuario VALUES (
    9,
    'Rol Usuario'
);

/*INSERT privilegios de usuario*/
INSERT INTO privilegiousuario VALUES (
    1,
    1,
    'Pensión'
);
INSERT INTO privilegiousuario VALUES (
    2,
    1,
    'Préstamo'
);
INSERT INTO privilegiousuario VALUES (
    3,
    2,
    'Gráficas'
);
INSERT INTO privilegiousuario VALUES (
    4,
    2,
    'Últimas transacciones'
);
INSERT INTO privilegiousuario VALUES (
    5,
    2,
    'Últimos clientes'
);
INSERT INTO privilegiousuario VALUES (
    6,
    3,
    'Consultar'
);
INSERT INTO privilegiousuario VALUES (
    7,
    3,
    'Registrar'
);
INSERT INTO privilegiousuario VALUES (
    8,
    3,
    'Editar'
);
INSERT INTO privilegiousuario VALUES (
    9,
    3,
    'Eliminar'
);
INSERT INTO privilegiousuario VALUES (
    10,
    3,
    'CargarDocumentos'
);
INSERT INTO privilegiousuario VALUES (
    11,
    4,
    'Consultar'
);
INSERT INTO privilegiousuario VALUES (
    12,
    4,
    'Registrar'
);
INSERT INTO privilegiousuario VALUES (
    13,
    4,
    'Editar'
);
INSERT INTO privilegiousuario VALUES (
    14,
    4,
    'Eliminar'
);
INSERT INTO privilegiousuario VALUES (
    15,
    5,
    'Estado de cuenta'
);
INSERT INTO privilegiousuario VALUES (
    16,
    5,
    'CheckList Documentos'
);
INSERT INTO privilegiousuario VALUES (
    17,
    6,
    'Consultar'
);
INSERT INTO privilegiousuario VALUES (
    18,
    6,
    'Registrar'
);
INSERT INTO privilegiousuario VALUES (
    19,
    6,
    'Editar'
);
INSERT INTO privilegiousuario VALUES (
    20,
    6,
    'Eliminar'
);
INSERT INTO privilegiousuario VALUES (
    21,
    7,
    'Consultar'
);
INSERT INTO privilegiousuario VALUES (
    22,
    7,
    'Registrar'
);
INSERT INTO privilegiousuario VALUES (
    23,
    7,
    'Editar'
);
INSERT INTO privilegiousuario VALUES (
    24,
    7,
    'Eliminar'
);
INSERT INTO privilegiousuario VALUES (
    25,
    8,
    'Consultar'
);
INSERT INTO privilegiousuario VALUES (
    26,
    8,
    'Registrar'
);
INSERT INTO privilegiousuario VALUES (
    27,
    8,
    'Editar'
);
INSERT INTO privilegiousuario VALUES (
    28,
    8,
    'Eliminar'
);
INSERT INTO privilegiousuario VALUES (
    29,
    9,
    'Consultar'
);
INSERT INTO privilegiousuario VALUES (
    30,
    9,
    'Registrar'
);
INSERT INTO privilegiousuario VALUES (
    31,
    9,
    'Editar'
);
INSERT INTO privilegiousuario VALUES (
    32,
    9,
    'Eliminar'
);


