#language: es
@frontend
Característica: Login de usuario
    Para poder acceder a ritsiGA
    Como usuario identificado
    Quiero ser capaz de loguearme en la plataforma

Antecedentes:
    Dado que existen los siguientes usuarios:
    | username  |     email     |   plainPassword   |  enabled  |  student_delegation    |  role    |
    |   user1   | user1@uco.es  | secret1           |   1       |        ceeps           |  -       |
    |   user2   | user2@uco.es  | secret2           |   0       |        cese            |  -       |


Escenario: Iniciar sesión con un usuario existente
    Dado estoy en "/login"
    Cuando presiono "Entrar"
    Y relleno lo siguiente:
    | username  | user1  |
    | password  | secret1  |
    Y presiono "_submit"
    Entonces estoy en la página de inicio
    Y debo ver "Inicio"

Escenario: Iniciar sesión con malas credenciales
    Dado estoy en "/login"
    Cuando presiono "Entrar"
    Y relleno lo siguiente:
    | username  | user1  |
    | password  | user1  |
    Y presiono "_submit"
    Entonces debo estar en "/login"

Escenario: Iniciar sesión con un usuario que no existe
    Dado estoy en "/login"
    Cuando presiono "Entrar"
    Y relleno lo siguiente:
    | username  | user3  |
    | password  | secret3  |
    Y presiono "_submit"
    Entonces debo ver "Bad credentials."

Escenario: Iniciar sesión con un usuario deshabilitado
    Dado estoy en "/login"
    Cuando presiono "Entrar"
    Y relleno lo siguiente:
    | username  | user2  |
    | password  | secret2  |
    Y presiono "_submit"
    Entonces debo ver "User account is disabled"