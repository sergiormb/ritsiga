#language: es
@frontend
Característica: Comprobar el funcionamiento de las inscripciones
    Para poder ver si podemos registrarnos correctamente
    Quiero ver inscripción confirmada

    Antecedentes:
        Dado que estoy autenticado como estudiante
        Y existen las asambleas:
        | nombre  | fechaInicio | fechaFin       |   dominio      |
        | Cádiz   | now         | +3 days        |   cadiz2014    |
        | Málaga  | now         | +3 days        |   malaga2016   |
        | Córdoba | -3 days     | -1 days        |   cordoba2013  |
        Y que existen las inscripciones:
        | nombre   | cargo              | usuario        |   asamblea     |  estado    |
        | Sergio   | Secretario         | usuario        |   cadiz2014    |  confirmed |
        | Sergio   | Tesorero           | usuario        |   malaga2016   |  paid      |


    Escenario: Entrar en la página de la asamblea
        Dado estoy en "/convention/malaga2016"
        Entonces debo ver "Inscribirse"

    Escenario: Comprobar mis inscripciones
        Dado estoy en "/convention/ritsi/inscripciones"
        Entonces debo ver "1 inscripciones confirmadas"
        Y debo ver "1 inscripciones pagadas"
