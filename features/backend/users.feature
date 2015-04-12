#language: es
@usuarios
Característica: Administrar usuarios
    Para administrar los usuarios
    Como administrador de la aplicación
    Quiero poder ver un panel de administración

Antecedentes:
    Dado que estoy autenticado como administrador
    Y que existen los siguientes usuarios:
    | username  | password  | email                 | role        |
    | admin     | adminpw   | admin@secret.com      | ROLE_ADMIN  |
    | sergio    | sergiopw  | sergio@secret.com     | ROLE_USER   |
    | johndoe   | johndoepw | johndoe@secret.com    | ROLE_ADMIN_CONVENTION  |
    | julio     | juliopw   | julio@ceeps.com       | ROLE_ADMIN_ORGANIZATION  |

    Escenario: Ver listado de todos los usuarios
        Dado que estoy en la página del listado de usuarios
        Entonces debo ver "5 resultados"