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


    Escenario: Exportar archivos a JSON
    Cuando voy a "/convention/ritsi/admin/app/user/list"
    Y sigo "JSON"
    Entonces el código de estado de la respuesta debe ser 200

    Escenario: Exportar archivos a XML
    Cuando voy a "/convention/ritsi/admin/app/user/list"
    Y sigo "XML"
    Entonces el código de estado de la respuesta debe ser 200

    Escenario: Exportar archivos a CSV
    Cuando voy a "/convention/ritsi/admin/app/user/list"
    Y sigo "CSV"
    Entonces el código de estado de la respuesta debe ser 200

    Escenario: Exportar archivos a XLS
    Cuando voy a "/convention/ritsi/admin/app/user/list"
    Y sigo "XLS"
    Entonces el código de estado de la respuesta debe ser 200

    Escenario: Borrar usuario desde el listado
    Cuando voy a "/convention/ritsi/admin/app/user/list"
    Y relleno "filter_username_value" con "johndoe"
    Y presiono "Filtrar"
    Y sigo "johndoe"
    Y sigo "Borrar"
    Entonces presiono " Sí, borrar" con clase "btn btn-danger"
    Y debo estar en "/convention/ritsi/admin/app/user/list"
    Y debo ver "Elemento eliminado satisfactoriamente."
    Pero no debo ver "johndoe"