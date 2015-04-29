#language: es
@login
Característica: Login de usuario
    Para poder acceder a ritsiGA
    Como usuario identificado
    Quiero ser capaz de inscribirme en la plataforma

Antecedentes:
    Dado que existen los siguientes usuarios:
    | username  |     email     |   plainPassword   |  enabled  |
    |   user1   | user1@uco.es  | secret1           |   1       |
    |   user2   | user2@uco.es  | secret2           |   0       |

Escenario: Registrarme con un usuario existente
    Dado estoy en "/login"
    Cuando presiono "Entrar"
    Y relleno lo siguiente:
    | username  | user1  |
    | password  | secret1  |
    Y presiono "_submit"
    Entonces debería estar en la página principal
    Y debería de ver "user1"
