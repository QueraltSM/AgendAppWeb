CREATE TABLE [usuarios]
(
    [id] INTEGER PRIMARY KEY,
    [cuenta] NVARCHAR(20),
    [clave] NVARCHAR(32) NOT NULL,
    [nombre] NVARCHAR(200) DEFAULT ''
);


CREATE UNIQUE INDEX IF NOT EXISTS [indexusuario] on [usuarios] ([cuenta]);

CREATE TABLE [notas]
(
    [id] INTEGER PRIMARY KEY,
    [titulo] NVARCHAR(80),
    [idusuario] INTEGER,
    [fecha] NVARCHAR(80),
    [contenido] TEXT,
    FOREIGN KEY ([idusuario]) REFERENCES [usuarios] ([id])
            ON DELETE CASCADE
);


INSERT INTO [usuarios] ([cuenta], [clave], [nombre])
     VALUES ('queraltsosa@gmail.com', '1234567', 'queralt');
INSERT INTO [usuarios] ([cuenta], [clave], [nombre])
     VALUES ('jaimebarreto@gmail.com', 'jejeje.390', 'jaime');


INSERT INTO [notas] ([titulo], [idusuario], [fecha], [contenido])
     VALUES ('Tareas del Lunes', '1', '1521995853', 'Práctica 2 de PI');
INSERT INTO [notas] ([titulo], [idusuario], [fecha], [contenido])
     VALUES ('Martes', '2', '1521995853', 'Montar un procesador');