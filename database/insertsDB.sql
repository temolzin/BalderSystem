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
    'Básico'
);
INSERT INTO tipousuario values(
    3,
    'Secretario'
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
    'BANAMEX',
    'Banco Nacional de México S.A'
);
INSERT INTO institucionbancaria VALUES (
    2,
    'BBVA',
    'Grupo Financiero BBVA Bancomer'
);
INSERT INTO institucionbancaria VALUES (
    3,
    'SANTANDER',
    'Grupo Financiero Santander'
);
INSERT INTO institucionbancaria VALUES (
    4,
    'HSBC',
    'Grupo Financiero HSBC'
);
INSERT INTO institucionbancaria VALUES (
    5,
    'SCOTIABANK',
    'Scotiabank Inverlat, S.A'
);
INSERT INTO institucionbancaria VALUES (
    6,
    'BANORTE',
    'Grupo Financiero Banorte'
);
INSERT INTO institucionbancaria VALUES (
    7,
    'BANCO AZTECA',
    'Banco Azteca, S.A'
);
INSERT INTO institucionbancaria VALUES (
    8,
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
