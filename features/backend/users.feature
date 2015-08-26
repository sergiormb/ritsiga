#language: es
@backend
Característica: Administrar usuarios
    Para administrar los usuarios
    Como administrador de la aplicación
    Quiero poder ver un panel de administración

Antecedentes:
    Dado existen las delegaciones de estudiantes:
    |     nombre     | ciudad   |   provincia      |
    |      ceeps     | cordoba  |   cordoba        |
    |      cese      | sevilla  |   sevilla        |
    Y que estoy autenticado como administrador
    Y que existen los siguientes usuarios:
    | username  | plainPassword  | email                 | role        |
    | admin     | adminpw   | admin@secret.com      | ROLE_ADMIN  |
    | sergio    | sergiopw  | sergio@secret.com     | ROLE_USER   |
    | johndoe   | johndoepw | johndoe@secret.com    | ROLE_ADMIN_CONVENTION  |
    | julio     | juliopw   | julio@ceeps.com       | ROLE_ADMIN_ORGANIZATION  |

    Escenario: Ver listado de todos los usuarios
        Cuando voy a "/convention/ritsi/admin/app/user/list"
        Entonces debo ver "5 resultados"