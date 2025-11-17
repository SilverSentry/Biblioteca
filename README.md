Estudiante: Gregory Abraham Arrieta Rios
C.I: 30.640.191
Asignatura: Lenguajes de Programación 2
Semestre: 5to

-.Análisis de Requerimiento

Módulo de Autenticación y Control de Acceso

Registro de Usuarios: El sistema debe proporcionar una interfaz para que los administradores registren nuevas cuentas de usuario del sistema. Esto incluye la captura de datos esenciales como nombre de usuario, correo electrónico y una contraseña segura.

Inicio de Sesión (Login): El sistema debe permitir el acceso a los usuarios registrados mediante la validación de sus credenciales (nombre de usuario/correo electrónico y contraseña).

Cierre de Sesión (Logout): El sistema debe permitir a cualquier usuario autenticado cerrar su sesión de forma manual y segura.

Restricción de Acceso: Todas las funcionalidades de administración (CRUD de Libros, Autores y Préstamos) solo deben ser accesibles tras una autenticación exitosa.

Módulo de Gestión de Inventario (CRUD): este módulo maneja la administración de los recursos principales de la biblioteca: Libros y Autores.

Gestión de Libros
CREAR Libro: Debe ser posible registrar un nuevo libro. Los datos mínimos a ingresar son: Título, ISBN (único), Año de Publicación y una relación obligatoria con un Autor existente.

LEER Libros: El sistema debe presentar un listado completo de todos los libros. Esta vista debe ser filtrable (por título, autor, ISBN) y paginada.

ACTUALIZAR Libro: Debe permitirse la modificación de todos los datos de un libro existente, excepto el ISBN.

ELIMINAR Libro: El sistema debe permitir eliminar un libro. Debe haber una validación estricta para impedir la eliminación si el libro tiene un préstamo activo.

Gestión de Autores
CREAR Autor: Debe ser posible registrar un nuevo autor, capturando su Nombre y otros datos relevantes como Nacionalidad.

LEER Autores: El sistema debe mostrar un listado de autores con opciones de búsqueda.

ACTUALIZAR Autor: Debe permitirse la modificación de los datos de un autor existente.

ELIMINAR Autor: El sistema debe permitir eliminar un autor. Se debe implementar una validación para evitar la eliminación si el autor tiene libros asociados en el inventario.

Módulo de Gestión de Préstamos (Lógica de Negocio Central): este módulo gestiona la interacción entre los Libros y los Lectores, aplicando la lógica relacional del negocio.

Gestión de Lectores
CREAR/LEER/ACTUALIZAR/ELIMINAR Lectores: Debe existir una interfaz CRUD simple para administrar los datos de los usuarios (lectores) a quienes se les prestan los libros. Los datos mínimos son Nombre Completo, Identificación y Contacto.

Lógica de Préstamos
CREAR Préstamo: Se debe poder iniciar un nuevo registro de préstamo seleccionando un Libro (del inventario) y un Lector (de la base de Lectores).

-.Lógica de Negocio

(Disponibilidad): Antes de crear el préstamo, el sistema debe verificar y garantizar que el estado del libro seleccionado sea "Disponible".

Lógica de Negocio (Fechas): El sistema debe registrar automáticamente la Fecha de Préstamo (fecha actual) y calcular una Fecha de Devolución Prevista.

Registrar Devolución: El sistema debe permitir cambiar el estado de un préstamo activo a "Devuelto", registrando la Fecha de Devolución Real.

Lógica de Negocio (Estado del Libro): Al registrar la devolución, el sistema debe actualizar el estado del libro de nuevo a "Disponible".

Visualización de Préstamos: El sistema debe mostrar un listado completo de todos los préstamos (activos e históricos). Este listado debe incluir filtros para ver solo préstamos "Activos" (no devueltos) y debe resaltar los préstamos que tienen la Fecha de Devolución Prevista vencida.
