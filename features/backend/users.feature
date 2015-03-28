#language: es
@usuarios
Característica: Administrar usuarios
    Para administrar los usuarios
    Como administrador de la aplicación
    Quiero poder ver un panel de administración

Antecedentes:
    Dado que existen los siguientes usuarios:
    | username  | password  | email                 | role        |
    | admin     | adminpw   | admin@secret.com      | ROLE_ADMIN  |
    | sergio    | sergiopw  | sergio@secret.com     | ROLE_USER   |
    | johndoe   | johndoepw | johndoe@secret.com    | ROLE_ADMIN  |

    Escenario: Ver listado de todos los usuarios
        Dado que estoy en la página del dashboard
        Entonces debería ver 3 usuarios en la lista