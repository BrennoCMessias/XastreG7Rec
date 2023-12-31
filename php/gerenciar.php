<?php
include('connect.php');

$cursoMessage = "";
$quizMessage = "";
$vagaMessage = "";

// Excluir um curso
if (isset($_GET['excluir_curso'])) {
    $idCurso = $_GET['excluir_curso'];

    $deleteQuery = "DELETE FROM curso WHERE id = '$idCurso'";
    $deleteResult = $mysqli->query($deleteQuery);

    if ($deleteResult) {
        $cursoMessage = "Curso excluído com sucesso!";
    } else {
        $cursoMessage = "Erro ao excluir o curso: " . $mysqli->error;
    }
}

// Excluir um quiz
if (isset($_GET['excluir_quiz'])) {
    $idQuiz = $_GET['excluir_quiz'];

    $deleteQuery = "DELETE FROM quiz WHERE id = '$idQuiz'";
    $deleteResult = $mysqli->query($deleteQuery);

    if ($deleteResult) {
        $quizMessage = "Quiz excluído com sucesso!";
    } else {
        $quizMessage = "Erro ao excluir o quiz: " . $mysqli->error;
    }
}

// Excluir uma vaga
if (isset($_GET['excluir_vaga'])) {
    $idVaga = $_GET['excluir_vaga'];

    $deleteQuery = "DELETE FROM vagas WHERE id_vaga = '$idVaga'";
    $deleteResult = $mysqli->query($deleteQuery);

    if ($deleteResult) {
        $vagaMessage = "Vaga excluída com sucesso!";
    } else {
        $vagaMessage = "Erro ao excluir a vaga: " . $mysqli->error;
    }
}

// Buscar todos os cursos
$cursoQuery = "SELECT * FROM curso";
$cursoResult = $mysqli->query($cursoQuery);

// Buscar todos os quizzes
$quizQuery = "SELECT * FROM quiz";
$quizResult = $mysqli->query($quizQuery);

// Buscar todas as vagas
$vagaQuery = "SELECT * FROM vagas";
$vagaResult = $mysqli->query($vagaQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar</title>
    <link rel="stylesheet" href="../frontend/main.css">
    <style>
        .button-wrapper {
            text-align: center;
        }
        .button-wrapper button {
            margin: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="login_container">
        <div class="login_css">
            <?php if (!empty($cursoMessage)): ?>
                <div class="button-wrapper">
                    <p><?php echo $cursoMessage; ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($quizMessage)): ?>
                <div class="button-wrapper">
                    <p><?php echo $quizMessage; ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($vagaMessage)): ?>
                <div class="button-wrapper">
                    <p><?php echo $vagaMessage; ?></p>
                </div>
            <?php endif; ?>

            <h1>GERENCIAR</h1>
            <h2>Cursos</h2>
            <?php if ($cursoResult->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nome Comercial</th>
                        <th>Descrição</th>
                        <th>Carga Horária</th>
                        <th>Data de Início das Inscrições</th>
                        <th>Data de Fim das Inscrições</th>
                        <th>Quantidade Máxima de Inscritos</th>
                        <th>Ações</th>
                    </tr>
                    <?php while ($curso = $cursoResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $curso['id']; ?></td>
                            <td><?php echo $curso['nome_comercial']; ?></td>
                            <td><?php echo $curso['descricao']; ?></td>
                            <td><?php echo $curso['carga_horaria']; ?></td>
                            <td><?php echo $curso['dat_ini']; ?></td>
                            <td><?php echo $curso['dat_fim']; ?></td>
                            <td><?php echo $curso['qtd_max']; ?></td>
                            <td>
                                <a href="editar_curso.php?id=<?php echo $curso['id']; ?>">Editar</a>
                                <a href="?excluir_curso=<?php echo $curso['id']; ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>Nenhum curso encontrado.</p>
            <?php endif; ?>

            <h2>Quizzes</h2>
            <?php if ($quizResult->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Curso ID</th>
                        <th>Pergunta</th>
                        <th>Resposta Correta</th>
                        <th>Resposta 1</th>
                        <th>Resposta 2</th>
                        <th>Ações</th>
                    </tr>
                    <?php while ($quiz = $quizResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $quiz['id']; ?></td>
                            <td><?php echo $quiz['curso_id']; ?></td>
                            <td><?php echo $quiz['pergunta']; ?></td>
                            <td><?php echo $quiz['resposta_correta']; ?></td>
                            <td><?php echo $quiz['resposta1']; ?></td>
                            <td><?php echo $quiz['resposta2']; ?></td>
                            <td>
                                <a href="editar_quiz.php?id=<?php echo $quiz['id']; ?>">Editar</a>
                                <a href="?excluir_quiz=<?php echo $quiz['id']; ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>Nenhum quiz encontrado.</p>
            <?php endif; ?>

            <h2>Vagas</h2>
            <?php if ($vagaResult->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>Vaga id</th>
                        <th>Título da Vaga</th>
                        <th>Curso ID</th>
                        <th>Empresa</th>
                        <th>Descrição</th>
                        <th>Faixa Salarial</th>
                        <th>Ações</th>
                    </tr>
                    <?php while ($vaga = $vagaResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $vaga['id_vaga']; ?></td>
                            <td><?php echo $vaga['titulo']; ?></td>
                            <td><?php echo $vaga['id_curso']; ?></td>
                            <td><?php echo $vaga['empresa']; ?></td>
                            <td><?php echo $vaga['descricao']; ?></td>
                            <td><?php echo $vaga['faixa_salarial']; ?></td>
                            <td>
                                <a href="editar_vaga.php?id=<?php echo $vaga['id_vaga']; ?>">Editar</a>
                                <a href="?excluir_vaga=<?php echo $vaga['id_vaga']; ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>Nenhuma vaga encontrada.</p>
            <?php endif; ?>
            </div>
    </div>
    <a href="../admin.html" class="btn-voltar">Voltar</a>
</body>
</html>
