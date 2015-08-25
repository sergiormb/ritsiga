#language: es
@usuarios
Característica: Administrar usuarios
    Para administrar los usuarios
    Como administrador de la aplicación
    Quiero poder ver un panel de administración

Antecedentes:
    Dado que existen las delegaciones de estudiantes:
    |     name       |     slug     |   city   |  address  |    province     |  postcode   |
    |      ceeps     |     ceeps    |   cordoba  |   cordoba   |   cordoba        |    14005      |
    |      cese      |      cese    |   sevilla  |   sevilla   |   sevilla        |    12001      |
    Y que estoy autenticado como administrador
    Y que existen los siguientes usuarios:
    | username  | plainPassword  | email                 | role        |  student_delegation    |
    | admin     | adminpw   | admin@secret.com      | ROLE_ADMIN  |        ceeps           |
    | sergio    | sergiopw  | sergio@secret.com     | ROLE_USER   |        ceeps           |
    | johndoe   | johndoepw | johndoe@secret.com    | ROLE_ADMIN_CONVENTION  |        ceeps           |
    | julio     | juliopw   | julio@ceeps.com       | ROLE_ADMIN_ORGANIZATION  |        ceeps           |

    Escenario: Ver listado de todos los usuarios
        Dado que estoy en la página del listado de usuarios
        Entonces debo ver "5 resultados"