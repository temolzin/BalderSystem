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
    'TipoUsuario'
);

/*INSERT privilegios de usuario*/
INSERT INTO privilegiousuario VALUES (
    1,
    1,
    'ModuloPension'
);
INSERT INTO privilegiousuario VALUES (
    2,
    1,
    'ModuloPrestamo'
);
INSERT INTO privilegiousuario VALUES (
    3,
    2,
    'InicioGraficas'
);
INSERT INTO privilegiousuario VALUES (
    4,
    2,
    'InicioUltimasTransacciones'
);
INSERT INTO privilegiousuario VALUES (
    5,
    2,
    'InicioUltimosClientes'
);
INSERT INTO privilegiousuario VALUES (
    6,
    3,
    'ConsultarCliente'
);
INSERT INTO privilegiousuario VALUES (
    7,
    3,
    'RegistrarCliente'
);
INSERT INTO privilegiousuario VALUES (
    8,
    3,
    'EditarCliente'
);
INSERT INTO privilegiousuario VALUES (
    9,
    3,
    'EliminarCliente'
);
INSERT INTO privilegiousuario VALUES (
    10,
    3,
    'CargarDocumentosCliente'
);
INSERT INTO privilegiousuario VALUES (
    11,
    4,
    'ConsultarTransaccion'
);
INSERT INTO privilegiousuario VALUES (
    12,
    4,
    'RegistrarTransaccion'
);
INSERT INTO privilegiousuario VALUES (
    13,
    4,
    'EditarTransaccion'
);
INSERT INTO privilegiousuario VALUES (
    14,
    4,
    'EliminarTransaccion'
);
INSERT INTO privilegiousuario VALUES (
    15,
    5,
    'EstadoCuentaReporte'
);
INSERT INTO privilegiousuario VALUES (
    16,
    5,
    'CheckListReporte'
);
INSERT INTO privilegiousuario VALUES (
    17,
    6,
    'ConsultarDocumento'
);
INSERT INTO privilegiousuario VALUES (
    18,
    6,
    'RegistrarDocumento'
);
INSERT INTO privilegiousuario VALUES (
    19,
    6,
    'EditarDocumento'
);
INSERT INTO privilegiousuario VALUES (
    20,
    6,
    'EliminarDocumento'
);
INSERT INTO privilegiousuario VALUES (
    21,
    7,
    'ConsultarConcepto'
);
INSERT INTO privilegiousuario VALUES (
    22,
    7,
    'RegistrarConcepto'
);
INSERT INTO privilegiousuario VALUES (
    23,
    7,
    'EditarConcepto'
);
INSERT INTO privilegiousuario VALUES (
    24,
    7,
    'EliminarConcepto'
);
INSERT INTO privilegiousuario VALUES (
    25,
    8,
    'ConsultarUsuario'
);
INSERT INTO privilegiousuario VALUES (
    26,
    8,
    'RegistrarUsuario'
);
INSERT INTO privilegiousuario VALUES (
    27,
    8,
    'EditarUsuario'
);
INSERT INTO privilegiousuario VALUES (
    28,
    8,
    'EliminarUsuario'
);
INSERT INTO privilegiousuario VALUES (
    29,
    9,
    'ConsultarTipoUsuario'
);
INSERT INTO privilegiousuario VALUES (
    30,
    9,
    'RegistrarTipoUsuario'
);
INSERT INTO privilegiousuario VALUES (
    31,
    9,
    'EditarTipoUsuario'
);
INSERT INTO privilegiousuario VALUES (
    32,
    9,
    'EliminarTipoUsuario'
);
/*INSERT Privilegios del tipo de usuario*/
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    1
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    2
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    3
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    4
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    5
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    6
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    7
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    8
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    9
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    10
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    11
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    12
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    13
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    14
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    15
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    16
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    17
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    18
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    19
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    20
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    21
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    22
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    23
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    24
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    25
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    26
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    27
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    28
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    29
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    30
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    31
);
INSERT INTO tipousuarioprivilegio VALUES (
    1,
    32
);



