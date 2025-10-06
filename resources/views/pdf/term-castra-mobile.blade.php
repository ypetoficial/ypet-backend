<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Termo de Autorização - Cirurgia e Anestesia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h1 {
            text-align: center;
        }
        .section {
            margin-top: 30px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 6px;
            margin-top: 4px;
            box-sizing: border-box;
        }
        .assinatura {
            margin-top: 60px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>TERMO DE AUTORIZAÇÃO PARA PROCEDIMENTOS CIRÚRGICOS E ANESTÉSICOS</h1>

    <div class="section">
        <h2>Dados do Tutor (Responsável)</h2>
        <label>Nome: {{ $name }}</label>
        <label>CPF: {{ $cpf }}</label>
        <label>Telefone: {{ $cellphone }}</label>
        <label>Endereço: {{ $address }}</label>
    </div>

    <div class="section">
        <h2>Dados do Animal (Paciente)</h2>
        <label>Nome: {{ $animal_name }}</label>
        <label>Espécie: {{ $animal_species }}</label>
        <label>Sexo: {{ $animal_sex }}</label>
        <label>Porte: {{ $animal_size }}</label>
        <label>Data de nascimento: {{ $animal_birthdate }}</label>
        <label>Cor: {{ $animal_color }}</label>
    </div>

    <div class="section">
        <p>
            Declaro estar ciente dos riscos da cirurgia e anestesia que será submetido o animal da minha propriedade
            e autorizo a sua realização, isentando a OSC Pet dos Vales, bem como o veterinário responsável pela
            realização do procedimento, de quaisquer responsabilidades em decorrência deste procedimento.
        </p>

        <p>
            *A cirurgia de castração em machos ocorre a retirada dos testículos e das fêmeas, retiradas dos cornos
            uterinos e dos ovários, não sendo possível a reprodução deles após a cirurgia.
        </p>

        <p>Declaro, ainda, que:</p>
        <ul>
            <li>1. Mantive o paciente em jejum pré-cirúrgico de 8 horas de água e comida conforme descrito no site que agendei;</li>
            <li>2. Estou sendo verdadeiro(a) com a idade do paciente;</li>
            <li>3. Estou ciente que serei o único responsável por quaisquer complicações pós cirúrgicas devido à:
                <ul>
                    <li>Falta do uso de roupa pós-cirúrgica e/ou colar elisabetano, bem como higiene local;</li>
                    <li>Falta de restrição de espaço e repouso;</li>
                    <li>Falta ou erro na administração correta dos medicamentos receitados.</li>
                </ul>
            </li>
        </ul>

        <p>
            Estou ciente que para realizar a cirurgia precisará realizar a tricotomia (tosa) com boa margem no local
            do procedimento e no membro anterior (braço) para colocar na fluidoterapia (soro), podendo também ser
            realizada no terço final da coluna para anestesia epidural.
        </p>

        <p>
            Caso haja emergencialmente a necessidade de algum outro procedimento não mencionado acima, também autorizo
            para o bem da saúde física dele(a).
        </p>

        <p>
            Autorizo que haja fotografias/vídeos com o(a) paciente acima descrito(a), podendo ser publicado em redes sociais.
        </p>

        <p>
            Autorizo a presença de estudantes acadêmicos de Medicina Veterinária, desde que acompanhados por um(a)
            responsável Médico(a) Veterinário(a) da clínica.
        </p>

        <p>
            O estabelecimento não se responsabiliza por utensílios deixados com o paciente (coleira, guia, panos, caixa de transporte e afins).
        </p>

        <p>
            Me responsabilizo por todos os custos extras ou outras intervenções médico-veterinárias que se fizerem necessárias
            em função da cirurgia.
        </p>

        <p>
            Declaro por fim, que li e estou de acordo com todas as descrições acima, como responsável do paciente acima descrito.
        </p>

        <label>Governador Valadares/MG, _____ de __________________ de 2024.</label>

        <div class="assinatura">
            <p>_________________________________<br>TUTOR (RESPONSÁVEL)</p>
        </div>
    </div>
</body>
</html>

